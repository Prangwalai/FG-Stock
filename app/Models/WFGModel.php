<?php

namespace App\Models;

use CodeIgniter\Model;

class WFGModel extends Model
{
    protected $db; 
    protected $table = 'w_fg_stock'; 
    protected $allowedFields = ['Date', 'ยอด_stock_เข้า', 'KPI', 'ยอดผลิต', 'แผนผลิต', 'remark'];

    public function __construct()
    {
        parent::__construct();
        
        // ดึง default database ที่ตั้งไว้ใน app/Config/Database.php
        $this->db = \Config\Database::connect('default');
    }

    // ดึงข้อมูลทั้งหมด
    public function getAll()
    {
        $sql = 'SELECT * FROM w_fg_stock';
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getMonthlySummary() {
        $sql = "SELECT YEAR(Date) as year, MONTH(Date) as month, MAX(Date) as Date 
        FROM w_fg_stock 
        GROUP BY YEAR(Date), MONTH(Date) 
        ORDER BY year DESC, month DESC";
        return $this->db->query($sql)->getResult();
    }

    public function getByMonth($year, $month)
    {
        $sql = "SELECT * FROM w_fg_stock 
                WHERE YEAR(Date) = ? AND MONTH(Date) = ? 
                ORDER BY Date ASC";

        return $this->db->query($sql, [$year, $month])->getResult(); // คืน object
    }

    public function getByDateRange($startDate, $endDate)
    {
        $sql = "SELECT * FROM w_fg_stock 
                WHERE Date BETWEEN ? AND ? 
                ORDER BY Date ASC";

        return $this->db->query($sql, [$startDate, $endDate])->getResult(); // คืน object
    }
    
}
