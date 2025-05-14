<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $role = $session->get('role');
        $uri = service('uri')->getSegment(1);

        // ตรวจสอบสิทธิ์
        $accessMap = [
            'admin' => ['dfg', 'fg', 'fgw', 'wfg'],
            'dm'    => ['dfg', 'fg'],
            'wn'    => ['fgw', 'wfg']
        ];

        if (!in_array($uri, $accessMap[$role] ?? [])) {
            return redirect()->to('/unauthorized');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
