<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\LoginLogModel;

class AuthController extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('LoginNavigator');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && $user['password'] === $password) { 

            $session->set([
                'username' => $user['username'],
                'name'     => $user['name'],      // ชื่อเต็ม
                'role'     => $user['role'],      // เช่น admin, dm_user, wn_user
                'logged_in' => true
            ]);

            // log login
            $logModel = new LoginLogModel();
            $logModel->save([
                'username' => $user['username'],
                'ip_address' => $this->request->getIPAddress()
            ]);

            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
