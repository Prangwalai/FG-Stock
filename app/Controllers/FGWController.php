<?php

namespace App\Controllers;

use App\Models\FGWModel;
use App\Models\WDailyStockModel;

class FGWController extends BaseController
{
    public function wnhome()
    {
        $model = new FGWModel();
        $data['items'] = $model->getAll();
        $data['sections'] = $model->getSec(); // ดึงข้อมูลทั้งหมด

        // print_r($data['items']);

        return view('WangNoi/WNAddView', $data);
    }

    public function create()
    {
        $items = $this->request->getPost('item');
        $recordDate = $this->request->getPost('record_date');

        $map = [
            'ITEM001' => 'WN_พาเลท_5_ชั้น_ถังมีน้ำ',
            'ITEM002' => 'WN_พาเลท_5_ชั้น_ถังเปล่า',
            'ITEM003' => 'WN_พาเลท_5_ชั้น_ไม่มีถัง',
            'ITEM004' => 'WN_พาเลท_5_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM005' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ',
            'ITEM006' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า',
            'ITEM007' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง',
            'ITEM008' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM009' => 'WN_พาเลท_6_ชั้น_ถังมีน้ำ',
            'ITEM010' => 'WN_พาเลท_6_ชั้น_ถังเปล่า',
            'ITEM011' => 'WN_พาเลท_6_ชั้น_ไม่มีถัง',
            'ITEM012' => 'WN_พาเลท_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM013' => 'WN_ฐานพาเลท_มีพาเลท',
            'ITEM014' => 'WN_ฐานพาเลทเปล่า_ไม่มีพาเลท',
            'ITEM015' => 'WN_พาเลทเปล่า_Loscam',
            'ITEM016' => 'WN_พาเลทเปล่า_CHEP',
            'ITEM017' => 'WN_พาเลทเหล็ก',
            'ITEM018' => 'WN_แผ่นรอง',
            'ITEM019' => 'WN_พาเลท_5_ชั้น_ชำรุดรอขาย',
            'ITEM020' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ชำรุดรอขาย',
            'ITEM021' => 'WN_พาเลท_6_ชั้น_ชำรุดรอขาย',
            'ITEM022' => 'WN_ฐานพาเลทสปริงเคิล_ชำรุดรอขาย',
            'ITEM023' => 'WN_ฐานพาเลทเนสท์เล่_ชำรุดรอขาย',
            'ITEM024' => 'WN_ถังไม่มีพาเลทใส่',
            'ITEM025' => 'WN_ถังเปล่ายังไม่ติดบาร์โค๊ต_บรรจุเข้าพาเลทแล้ว',
            'ITEM026' => 'WN_ถังเปล่ายังไม่ติดบาร์โค๊ต_ไม่มีพาเลทใส่',
            'ITEM027' => 'WN_ถังทำลาย',
            'ITEM028' => 'WN_GAS',
            'ITEM029' => 'WN_สปริงเคิล_อนุเคราะห์',
            'ITEM030' => 'WN_d_boss_อนุเคราะห์',
            'ITEM031' => 'WN_d_boss_7_11',
            'ITEM032' => 'WN_sprinkle_btc_350',
            'ITEM033' => 'WN_d_boss_btc',
            'ITEM034' => 'WN_sprinkle_btc_1500',
            'ITEM035' => 'WN_sprinkle_btc_6000_1',
            'ITEM037' => 'WN_พัทยา_350',
            'ITEM038' => 'WN_พัทยา_550',
            'ITEM039' => 'WN_พัทยา_1500',
            'ITEM040' => 'WN_barter_6000',
        ];

        $dataToInsert = [];

        
        foreach ($items as $itemCode => $value) {
            if (isset($map[$itemCode])) {
                $columnName = $map[$itemCode];
                $dataToInsert[$columnName] = $value;
            }
        }

        $dataToInsert['Date'] = $recordDate ? date('Y-m-d', strtotime($recordDate)) : date('Y-m-d');
        // dd($recordDate);
        // 4. บันทึกลง model
        $model = new WDailyStockModel();
        $model->insert($dataToInsert);

        return redirect()->to('/wn')->with('message', 'บันทึกเรียบร้อย');
    }

    public function update($record_date)
    {
        $items = $this->request->getPost('item'); // data[DM_พาเลท_5_ชั้น_ถังมีน้ำ] => 10

        // Mapping item_code => column_name (เหมือนใน create)
        $map = [
            'ITEM001' => 'WN_พาเลท_5_ชั้น_ถังมีน้ำ',
            'ITEM002' => 'WN_พาเลท_5_ชั้น_ถังเปล่า',
            'ITEM003' => 'WN_พาเลท_5_ชั้น_ไม่มีถัง',
            'ITEM004' => 'WN_พาเลท_5_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM005' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ',
            'ITEM006' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า',
            'ITEM007' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง',
            'ITEM008' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM009' => 'WN_พาเลท_6_ชั้น_ถังมีน้ำ',
            'ITEM010' => 'WN_พาเลท_6_ชั้น_ถังเปล่า',
            'ITEM011' => 'WN_พาเลท_6_ชั้น_ไม่มีถัง',
            'ITEM012' => 'WN_พาเลท_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM013' => 'WN_ฐานพาเลท_มีพาเลท',
            'ITEM014' => 'WN_ฐานพาเลทเปล่า_ไม่มีพาเลท',
            'ITEM015' => 'WN_พาเลทเปล่า_Loscam',
            'ITEM016' => 'WN_พาเลทเปล่า_CHEP',
            'ITEM017' => 'WN_พาเลทเหล็ก',
            'ITEM018' => 'WN_แผ่นรอง',
            'ITEM019' => 'WN_พาเลท_5_ชั้น_ชำรุดรอขาย',
            'ITEM020' => 'WN_พาเลทเนสท์เล่_6_ชั้น_ชำรุดรอขาย',
            'ITEM021' => 'WN_พาเลท_6_ชั้น_ชำรุดรอขาย',
            'ITEM022' => 'WN_ฐานพาเลทสปริงเคิล_ชำรุดรอขาย',
            'ITEM023' => 'WN_ฐานพาเลทเนสท์เล่_ชำรุดรอขาย',
            'ITEM024' => 'WN_ถังไม่มีพาเลทใส่',
            'ITEM025' => 'WN_ถังเปล่ายังไม่ติดบาร์โค๊ต_บรรจุเข้าพาเลทแล้ว',
            'ITEM026' => 'WN_ถังเปล่ายังไม่ติดบาร์โค๊ต_ไม่มีพาเลทใส่',
            'ITEM027' => 'WN_ถังทำลาย',
            'ITEM028' => 'WN_GAS',
            'ITEM029' => 'WN_สปริงเคิล_อนุเคราะห์',
            'ITEM030' => 'WN_d_boss_อนุเคราะห์',
            'ITEM031' => 'WN_d_boss_7_11',
            'ITEM032' => 'WN_sprinkle_btc_350',
            'ITEM033' => 'WN_d_boss_btc',
            'ITEM034' => 'WN_sprinkle_btc_1500',
            'ITEM035' => 'WN_sprinkle_btc_6000_1',
            'ITEM037' => 'WN_พัทยา_350',
            'ITEM038' => 'WN_พัทยา_550',
            'ITEM039' => 'WN_พัทยา_1500',
            'ITEM040' => 'WN_barter_6000',
        ];

        $dataToUpdate = [];

        foreach ($items as $item_code => $value) {
            if (isset($map[$item_code])) {
                $columnName = $map[$item_code];
                $dataToUpdate[$columnName] = $value;
            }
        }

        if (empty($dataToUpdate)) {
            return redirect()->back()->with('error', 'ไม่มีข้อมูลใหม่สำหรับการอัปเดต');
        }

        $model = new WDailyStockModel();
        $model->where('Date', $record_date)->set($dataToUpdate)->update();

        return redirect()->to('/wn')->with('message', 'อัปเดตเรียบร้อยแล้ว');
    }

    public function delete($id)
    {
        $model = new FGWModel();
        $model->delete($id);
        return redirect()->to('/fg');
    }
}
