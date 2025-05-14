<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\LoginLogModel;

class DashboardController extends BaseController
{

    public function index()
    {
        $session = session();
        $username = $session->get('username'); // หรือใช้ตาม key ที่คุณ set
        $role = $session->get('role'); // เพิ่ม key 'role' ด้วยตอน login
        $name = $session->get('name');


        $accessMap = [
            'admin' => ['dfg', 'fg', 'fgw', 'wfg'],
            'dm'    => ['dfg', 'fg'],
            'wn'    => ['fgw', 'wfg']
        ];

        $allowedRoutes = $accessMap[$role] ?? [];

        return view('dashboard', [
            'username' => $username,
            'role' => $role,
            'name' => $name,
            'allowedRoutes' => $allowedRoutes,
            
        ]);
    }

    
}
