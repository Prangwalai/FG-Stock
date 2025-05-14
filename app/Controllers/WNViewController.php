<?php

namespace App\Controllers;

use App\Models\FGWModel;
use App\Models\WDailyStockModel;

class WNViewController extends BaseController
{
    public function index()
    {
        $model = new WDailyStockModel();
        $data['records'] = $model->select('ID, Date')->orderBy('Date', 'desc')->findAll();

        return view('WangNoi/WNHome', $data); // แสดงรายการวันที่
    }

    public function view($date)
    {
        $stockModel = new WDailyStockModel();
        $fgdModel = new FGWModel();

        // ดึงข้อมูลสต๊อกตามวันที่
        $record = $stockModel->where('Date', $date)->first();

        if (!$record) {
            throw PageNotFoundException::forPageNotFound("ไม่พบข้อมูลวันที่ $date");
        }

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

        return view('WangNoi/WNDetail', $data);
    }


    // public function edit($record_date)
    // {
    //     $model = new WDailyStockModel();
    //     $record = $model->where('Date', $record_date)->first();

    //     if (!$record) {
    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("ไม่พบข้อมูลวันที่ $record_date");
    //     }

    //     return view('WangNoi/WNEditView', ['record' => $record]);
    // }

    public function edit($date)
    {
        $stockModel = new WDailyStockModel();
        $fgdModel = new FGWModel();

        $record = $stockModel->where('Date', $date)->first();

        if (!$record) {
            throw PageNotFoundException::forPageNotFound("ไม่พบข้อมูลวันที่ $date");
        }

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

        return view('WangNoi/WNEditView', $data);  // ใช้ view แบบแก้ไขได้
    }

    public function dailyView()
    {
        $model = new WDailyStockModel();

        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        if ($startDate && $endDate) {
            $data['daily'] = $model->getByDateRange($startDate, $endDate);
        } else {
            $data['daily'] = $model->getAll();
        }

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view('WangNoi/WNHome', $data);
    }

    public function delete($id)
    {
        $model = new WDailyStockModel();
        $model->delete($id);
        return redirect()->to('/wn');
    }

}
