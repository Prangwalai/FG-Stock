<?php

namespace App\Controllers;

use App\Models\FGDModel;
use App\Models\DailyStockModel;

class FGDController extends BaseController
{
    public function dmhome()
    {
        $model = new FGDModel();
        $data['items'] = $model->getAll();
        $data['sections'] = $model->getSec(); // ดึงข้อมูลทั้งหมด

        // print_r($data['items']);

        return view('DonMuang/DMAddView', $data);
    }

    public function DMAddView()
    {
        $model = new FGDModel();
        $data['summary'] = $model->getSum();
        return view('DMAddView', $data);
    }

    public function create()
    {
        $items = $this->request->getPost('item');
        $recordDate = $this->request->getPost('record_date');

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

        $dataToInsert = [];

        // 2. วน loop เพื่อแมปค่าที่ส่งมาจาก form ไปยัง column
        foreach ($items as $itemCode => $value) {
            if (isset($map[$itemCode])) {
                $columnName = $map[$itemCode];
                $dataToInsert[$columnName] = $value;
            }
        }

        $dataToInsert['Date'] = $recordDate ? date('Y-m-d', strtotime($recordDate)) : date('Y-m-d');
        // dd($recordDate);
        // 4. บันทึกลง model
        $model = new DailyStockModel();
        $model->insert($dataToInsert);

        return redirect()->to('/dm')->with('message', 'บันทึกเรียบร้อย');
    }

    public function update($record_date)
    {
        $items = $this->request->getPost('item'); // data[DM_พาเลท_5_ชั้น_ถังมีน้ำ] => 10

        // Mapping item_code => column_name (เหมือนใน create)
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

        $model = new DailyStockModel();
        $model->where('Date', $record_date)->set($dataToUpdate)->update();

        return redirect()->to('/dm')->with('message', 'อัปเดตเรียบร้อยแล้ว');
    }

    public function delete($id)
    {
        $model = new FGDModel();
        $model->delete($id);
        return redirect()->to('/fg');
    }
}
