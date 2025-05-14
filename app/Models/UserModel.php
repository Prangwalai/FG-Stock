<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_login';
    protected $allowedFields = ['username', 'password', 'name', 'role','last_login'];
}