<?php
namespace App\Models;

use CodeIgniter\Model;

class WDailyStockModel extends Model
{
    protected $table = 'wn_fg_stock';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID',
        'Date',
        'WN_พาเลท_5_ชั้น_ถังมีน้ำ',
        'WN_พาเลท_5_ชั้น_ถังเปล่า',
        'WN_พาเลท_5_ชั้น_ไม่มีถัง',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง',
        'WN_พาเลท_6_ชั้น_ถังมีน้ำ',
        'WN_พาเลท_6_ชั้น_ถังเปล่า',
        'WN_พาเลท_6_ชั้น_ไม่มีถัง',
        'WN_ฐานพาเลท_มีพาเลท',
        'WN_ฐานพาเลทเปล่า_ไม่มีพาเลท',
        'WN_ถังไม่มีพาเลทใส่',
        'WN_ถังทำลาย',
        'WN_พาเลท_5_ชั้น_ชำรุดรอขาย',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ชำรุดรอขาย',
        'WN_พาเลท_6_ชั้น_ชำรุดรอขาย',
        'WN_ฐานพาเลทสปริงเคิล_ชำรุดรอขาย',
        'WN_ฐานพาเลทเนสท์เล่_ชำรุดรอขาย',
        'WN_พาเลทเปล่า_Loscam',
        'WN_พาเลทเปล่า_CHEP',
        'WN_พาเลทเหล็ก',
        'WN_แผ่นรอง',
        'WN_GAS',
        'WN_ถังเปล่ายังไม่ติดบาร์โค๊ต_บรรจุเข้าพาเลทแล้ว',
        'WN_ถังเปล่ายังไม่ติดบาร์โค๊ต_ไม่มีพาเลทใส่',
        'WN_พาเลท_5_ชั้น_ถังมีน้ำ_ถังหมุนเวียน',
        'WN_พาเลท_5_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'WN_พาเลท_5_ชั้น_ไม่มีถัง_ถังหมุนเวียน',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ_ถังหมุนเวียน',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'WN_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง_ถังหมุนเวียน',
        'WN_พาเลท_6_ชั้น_ถังมีน้ำ_ถังหมุนเวียน',
        'WN_พาเลท_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'WN_พาเลท_6_ชั้น_ไม่มีถัง_ถังหมุนเวียน',
        'WN_สปริงเคิล_อนุเคราะห์',
        'WN_d_boss_อนุเคราะห์',
        'WN_d_boss_7_11',
        'WN_sprinkle_btc_350',
        'WN_d_boss_btc',
        'WN_sprinkle_btc_1500',
        'WN_sprinkle_btc_6000_1',
        'WN_สปริงเคิล_btc_6000_2',
        'WN_พัทยา_350',
        'WN_พัทยา_550',
        'WN_พัทยา_1500',
        'WN_barter_6000'];

        public function __construct()
        {
            parent::__construct();
            
            // ดึง default database ที่ตั้งไว้ใน app/Config/Database.php
            $this->db = \Config\Database::connect('default');
        }

        public function getAll()
        {
            $sql = 'SELECT * FROM wn_fg_stock';
            $query = $this->db->query($sql);
            return $query->getResult();
        }

        public function getByDateRange($startDate, $endDate)
        {
            $sql = "SELECT * FROM wn_fg_stock 
                WHERE Date BETWEEN ? AND ? 
                ORDER BY Date ASC";

            return $this->db->query($sql, [$startDate, $endDate])->getResult(); // คืน object
        }

         // ลบข้อมูล
        public function deleteData($id)
        {
            return $this->db->table($this->table)
                        ->where('ID', $id)
                        ->delete();
        }
}