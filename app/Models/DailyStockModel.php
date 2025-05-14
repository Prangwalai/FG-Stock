<?php
namespace App\Models;

use CodeIgniter\Model;

class DailyStockModel extends Model
{
    protected $table = 'dm_fg_stock';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID',
        'Date',
        'DM_พาเลท_5_ชั้น_ถังมีน้ำ',
        'DM_พาเลท_5_ชั้น_ถังเปล่า',
        'DM_พาเลท_5_ชั้น_ไม่มีถัง',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง',
        'DM_พาเลท_6_ชั้น_ถังมีน้ำ',
        'DM_พาเลท_6_ชั้น_ถังเปล่า',
        'DM_พาเลท_6_ชั้น_ไม่มีถัง',
        'DM_ฐานพาเลท_มีพาเลท',
        'DM_ฐานพาเลทเปล่า_ไม่มีพาเลท',
        'DM_ถังไม่มีพาเลทใส่',
        'DM_ถังทำลาย',
        'DM_พาเลท_5_ชั้น_ชำรุดรอขาย',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ชำรุดรอขาย',
        'DM_พาเลท_6_ชั้น_ชำรุดรอขาย',
        'DM_ฐานพาเลทสปริงเคิล_ชำรุดรอขาย',
        'DM_ฐานพาเลทเนสท์เล่_ชำรุดรอขาย',
        'DM_พาเลทเปล่า_Loscam',
        'DM_พาเลทเปล่า_CHEP',
        'DM_พาเลทเหล็ก',
        'DM_แผ่นรอง',
        'DM_GAS',
        'DM_ถังเปล่ายังไม่ติดบาร์โค๊ต_บรรจุเข้าพาเลทแล้ว',
        'DM_ถังเปล่ายังไม่ติดบาร์โค๊ต_ไม่มีพาเลทใส่',
        'DM_พาเลท_5_ชั้น_ถังมีน้ำ_ถังหมุนเวียน',
        'DM_พาเลท_5_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'DM_พาเลท_5_ชั้น_ไม่มีถัง_ถังหมุนเวียน',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ถังมีน้ำ_ถังหมุนเวียน',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'DM_พาเลทเนสท์เล่_6_ชั้น_ไม่มีถัง_ถังหมุนเวียน',
        'DM_พาเลท_6_ชั้น_ถังมีน้ำ_ถังหมุนเวียน',
        'DM_พาเลท_6_ชั้น_ถังเปล่า_ถังหมุนเวียน',
        'DM_พาเลท_6_ชั้น_ไม่มีถัง_ถังหมุนเวียน',
        'DM_สปริงเคิล_อนุเคราะห์',
        'DM_d_boss_อนุเคราะห์',
        'DM_d_boss_7_11',
        'DM_sprinkle_btc_350',
        'DM_d_boss_btc',
        'DM_sprinkle_btc_1500',
        'DM_sprinkle_btc_6000_1',
        'DM_สปริงเคิล_btc_6000_2',
        'DM_พัทยา_350',
        'DM_พัทยา_550',
        'DM_พัทยา_1500',
        'DM_barter_6000'];

        public function __construct()
        {
            parent::__construct();
            
            // ดึง default database ที่ตั้งไว้ใน app/Config/Database.php
            $this->db = \Config\Database::connect('default');
        }

        public function getAll()
        {
            $sql = 'SELECT * FROM dm_fg_stock';
            $query = $this->db->query($sql);
            return $query->getResult();
        }

        public function getByDateRange($startDate, $endDate)
        {
            $sql = "SELECT * FROM dm_fg_stock 
                WHERE Date BETWEEN ? AND ? 
                ORDER BY Date ASC";

            return $this->db->query($sql, [$startDate, $endDate])->getResult(); // คืน object
        }

        public function deleteData($id)
        {
            return $this->db->table($this->table)
                        ->where('ID', $id)
                        ->delete();
        }
}