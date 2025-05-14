<?php

namespace App\Models;

use CodeIgniter\Model;

class FGWModel extends Model
{
    protected $db; 
    // protected $table = 'your_table_name'; // <-- เปลี่ยนชื่อตารางตามจริง

    public function __construct()
    {
        parent::__construct();
        
        // ดึง default database ที่ตั้งไว้ใน app/Config/Database.php
        $this->db = \Config\Database::connect('default');
    }

    // ดึงข้อมูลทั้งหมด
    public function getAll()
    {
        $sql = 'SELECT si.*, sr.section_name FROM stock_items si LEFT JOIN ref_section sr ON si.section = sr.section_code';
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getSec()
    {
        $sql = 'SELECT * FROM ref_section';
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getSum()
    {
        $sql = 'SELECT * FROM wn_fg_stock';
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // ดึงข้อมูลตาม id
    public function getById($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get()
                        ->getRow(); // หรือ ->getRowArray()
    }

    // เพิ่มข้อมูล
    public function insertData($data)
    {
        return $this->db->table($this->table)
                        ->insert($data);
    }

    // อัปเดตข้อมูล
    public function updateData($id, $data)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->update($data);
    }

    // ลบข้อมูล
    public function deleteData($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->delete();
    }
}
