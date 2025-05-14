<?php

namespace App\Models;
use CodeIgniter\Model;

class LoginLogModel extends Model
{
    protected $table = 'login_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'ip_address'];
    public $useAutoIncrement = true;
}