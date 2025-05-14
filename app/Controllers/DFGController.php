<?php

namespace App\Controllers;

use App\Models\DFGModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class DFGController extends BaseController
{
    public function dmhome()
    {
        $model = new DFGModel();
        $data['daily'] = $model->getAll();

        // print_r($data['items']);

        return view('DonMuang/StockDailyViewDM', $data);
    }

    public function save() {

        $model = new DFGModel();
        $id = $this->request->getPost('id'); 
        $data = [
            'Date' => $this->request->getPost('date'),
            'ยอด_stock_เข้า' => $this->request->getPost('stock_in'),
            'KPI' => $this->request->getPost('kpi'),
            'ยอดผลิต' => $this->request->getPost('actual_production'),
            'แผนผลิต' => $this->request->getPost('planned_production'),
            'remark' => $this->request->getPost('remark'),
        ];
    
        $id = $this->request->getPost('id');
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
    
        return redirect()->to('/dfg');
    }

    public function delete($id)
    {
        $model = new DFGModel();

        $model->delete($id);

        return redirect()->to('/dfg');
    }

    public function dailyView()
    {
        $model = new DFGModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $data['daily'] = $model->getByDateRange($startDate, $endDate);
        } else {
            $data['daily'] = $model->getAll();
        }

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view('DonMuang/StockDailyViewDM', $data);
    }


    public function exportExcel()
    {
        $model = new DFGModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->back()->with('error', 'กรุณาระบุช่วงวันที่ให้ครบถ้วน');
        }

        if ($startDate && $endDate) {
            $data = $model->getByDateRange($startDate, $endDate);
        } else {
            $data = $model->getAll();
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // กำหนดหัวตาราง
        $sheet->setCellValue('A1', 'วันที่');
        $sheet->setCellValue('B1', 'ยอด Stock เข้า');
        $sheet->setCellValue('C1', 'KPI');
        $sheet->setCellValue('D1', 'ยอดผลิต');
        $sheet->setCellValue('E1', 'แผนผลิต');
        $sheet->setCellValue('F1', 'หมายเหตุ');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->Date);
            $sheet->setCellValue('B' . $row, $item->ยอด_stock_เข้า);
            $sheet->setCellValue('C' . $row, $item->KPI);
            $sheet->setCellValue('D' . $row, $item->ยอดผลิต);
            $sheet->setCellValue('E' . $row, $item->แผนผลิต);
            $sheet->setCellValue('F' . $row, $item->remark);
            $row++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'รายงานยอดสต๊อกน้ำถัง 18.9 ลิตร คงเหลือเทียบผลิตประจำวัน : ดอนเมือง ' . date('Ymd_His') . '.xlsx';

        // ส่งไฟล์ให้ดาวน์โหลด
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        $writer->save('php://output');
        exit;
    }


}
