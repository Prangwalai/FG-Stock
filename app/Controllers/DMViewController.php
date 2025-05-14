<?php

namespace App\Controllers;

use App\Models\FGDModel;
use App\Models\DailyStockModel;

class DMViewController extends BaseController
{
    public function index()
    {
        $model = new DailyStockModel();
        $data['records'] = $model->select('ID, Date')->orderBy('Date', 'desc')->findAll();

        return view('DonMuang/DMHome', $data); // แสดงรายการวันที่
    }

    public function view($date)
    {
        $stockModel = new DailyStockModel();
        $fgdModel = new FGDModel();

        // ดึงข้อมูลสต๊อกตามวันที่
        $record = $stockModel->where('Date', $date)->first();

        if (!$record) {
            throw PageNotFoundException::forPageNotFound("ไม่พบข้อมูลวันที่ $date");
        }

        $map = [
            'ITEM001' => 'DM_พาเลท_5_ชั้น_ถังมีน้ำ',
            'ITEM002' => 'DM_พาเลท_5_ชั้น_ถังเปล่า',
            'ITEM003' => 'DM_พาเลท_5_ชั้น_ไม่มีถัง',
            'ITEM004' => 'DM_พาเลท_5_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM005' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ',
            'ITEM006' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า',
            'ITEM007' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง',
            'ITEM008' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM009' => 'DM_พาเลท_6_ชั้น_ถังมีน้ำ',
            'ITEM010' => 'DM_พาเลท_6_ชั้น_ถังเปล่า',
            'ITEM011' => 'DM_พาเลท_6_ชั้น_ไม่มีถัง',
            'ITEM012' => 'DM_พาเลท_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
            'ITEM013' => 'DM_ฐานพาเลท_มีพาเลท',
            'ITEM014' => 'DM_ฐานพาเลทเปล่า_ไม่มีพาเลท',
            'ITEM015' => 'DM_พาเลทเปล่า_Loscam',
            'ITEM016' => 'DM_พาเลทเปล่า_CHEP',
            'ITEM017' => 'DM_พาเลทเหล็ก',
            'ITEM018' => 'DM_แผ่นรอง',
            'ITEM019' => 'DM_พาเลท_5_ชั้น_ชำรุดรอขาย',
            'ITEM020' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ชำรุดรอขาย',
            'ITEM021' => 'DM_พาเลท_6_ชั้น_ชำรุดรอขาย',
            'ITEM022' => 'DM_ฐานพาเลทสปริงเคิล_ชำรุดรอขาย',
            'ITEM023' => 'DM_ฐานพาเลทเนสท์เล่_ชำรุดรอขาย',
            'ITEM024' => 'DM_ถังไม่มีพาเลทใส่',
            'ITEM025' => 'DM_ถังเปล่ายังไม่ติดบาร์โค๊ต_บรรจุเข้าพาเลทแล้ว',
            'ITEM026' => 'DM_ถังเปล่ายังไม่ติดบาร์โค๊ต_ไม่มีพาเลทใส่',
            'ITEM027' => 'DM_ถังทำลาย',
            'ITEM028' => 'DM_GAS',
            'ITEM029' => 'DM_สปริงเคิล_อนุเคราะห์',
            'ITEM030' => 'DM_d_boss_อนุเคราะห์',
            'ITEM031' => 'DM_d_boss_7_11',
            'ITEM032' => 'DM_sprinkle_btc_350',
            'ITEM033' => 'DM_d_boss_btc',
            'ITEM034' => 'DM_sprinkle_btc_1500',
            'ITEM035' => 'DM_sprinkle_btc_6000_1',
            'ITEM037' => 'DM_พัทยา_350',
            'ITEM038' => 'DM_พัทยา_550',
            'ITEM039' => 'DM_พัทยา_1500',
            'ITEM040' => 'DM_barter_6000',
        ];

    $itemData = [];
    foreach ($map as $code => $columnName) {
        $itemData[$code] = isset($record[$columnName]) ? $record[$columnName] : 0;
    }
        $data = [
            'record'   => $record,
            'sections' => $fgdModel->getSec(),   // ต้องมี method นี้ใน FGDModel
            'items'    => $fgdModel->getAll(),   // ต้องมี method นี้ใน FGDModel
            'itemMap'  => $map,
            'itemData' => $itemData
        ];

        return view('DonMuang/DMDetail', $data);
    }


    public function edit($date)
    {
        $stockModel = new DailyStockModel();
        $fgdModel = new FGDModel();

        $record = $stockModel->where('Date', $date)->first();

        if (!$record) {
            throw PageNotFoundException::forPageNotFound("ไม่พบข้อมูลวันที่ $date");
        }

        $map = [ 
        'ITEM001' => 'DM_พาเลท_5_ชั้น_ถังมีน้ำ',
        'ITEM002' => 'DM_พาเลท_5_ชั้น_ถังเปล่า',
        'ITEM003' => 'DM_พาเลท_5_ชั้น_ไม่มีถัง',
        'ITEM004' => 'DM_พาเลท_5_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'ITEM005' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ',
        'ITEM006' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า',
        'ITEM007' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง',
        'ITEM008' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'ITEM009' => 'DM_พาเลท_6_ชั้น_ถังมีน้ำ',
        'ITEM010' => 'DM_พาเลท_6_ชั้น_ถังเปล่า',
        'ITEM011' => 'DM_พาเลท_6_ชั้น_ไม่มีถัง',
        'ITEM012' => 'DM_พาเลท_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'ITEM013' => 'DM_ฐานพาเลท_มีพาเลท',
        'ITEM014' => 'DM_ฐานพาเลทเปล่า_ไม่มีพาเลท',
        'ITEM015' => 'DM_พาเลทเปล่า_Loscam',
        'ITEM016' => 'DM_พาเลทเปล่า_CHEP',
        'ITEM017' => 'DM_พาเลทเหล็ก',
        'ITEM018' => 'DM_แผ่นรอง',
        'ITEM019' => 'DM_พาเลท_5_ชั้น_ชำรุดรอขาย',
        'ITEM020' => 'DM_พาเลทเนสท์เล่_6_ชั้น_ชำรุดรอขาย',
        'ITEM021' => 'DM_พาเลท_6_ชั้น_ชำรุดรอขาย',
        'ITEM022' => 'DM_ฐานพาเลทสปริงเคิล_ชำรุดรอขาย',
        'ITEM023' => 'DM_ฐานพาเลทเนสท์เล่_ชำรุดรอขาย',
        'ITEM024' => 'DM_ถังไม่มีพาเลทใส่',
        'ITEM025' => 'DM_ถังเปล่ายังไม่ติดบาร์โค๊ต_บรรจุเข้าพาเลทแล้ว',
        'ITEM026' => 'DM_ถังเปล่ายังไม่ติดบาร์โค๊ต_ไม่มีพาเลทใส่',
        'ITEM027' => 'DM_ถังทำลาย',
        'ITEM028' => 'DM_GAS',
        'ITEM029' => 'DM_สปริงเคิล_อนุเคราะห์',
        'ITEM030' => 'DM_d_boss_อนุเคราะห์',
        'ITEM031' => 'DM_d_boss_7_11',
        'ITEM032' => 'DM_sprinkle_btc_350',
        'ITEM033' => 'DM_d_boss_btc',
        'ITEM034' => 'DM_sprinkle_btc_1500',
        'ITEM035' => 'DM_sprinkle_btc_6000_1',
        'ITEM037' => 'DM_พัทยา_350',
        'ITEM038' => 'DM_พัทยา_550',
        'ITEM039' => 'DM_พัทยา_1500',
        'ITEM040' => 'DM_barter_6000',
    ]; // (คัดลอก map เดิมมาเลย)

        $itemData = [];
        foreach ($map as $code => $columnName) {
            $itemData[$code] = isset($record[$columnName]) ? $record[$columnName] : 0;
        }

        $data = [
            'record'   => $record,
            'sections' => $fgdModel->getSec(),
            'items'    => $fgdModel->getAll(),
            'itemMap'  => $map,
            'itemData' => $itemData
        ];

        return view('DonMuang/DMEditView', $data);  // ใช้ view แบบแก้ไขได้
    }

    public function dailyView()
    {
        $model = new DailyStockModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $data['daily'] = $model->getByDateRange($startDate, $endDate);
        } else {
            $data['daily'] = $model->getAll();
        }

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view('DonMuang/DMHome', $data);
    }

    public function delete($id)
    {
        $model = new DailyStockModel();
        $model->delete($id);
        return redirect()->to('/dm');
    }
}
