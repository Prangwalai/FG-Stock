<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
#ดอนเมือง
// $routes->get('/fg', 'FGDController::dmhome');
// $routes->post('/fg', 'FGDController::create');
$routes->get('/dm', 'DMViewController::index');
$routes->get('/fg/dmview/(:segment)', 'DMViewController::view/$1');
$routes->get('/fg/dmhome', 'FGDController::dmhome');
$routes->get('/fg/dailyView', 'DMViewController::dailyView');
$routes->get('/fg/dmedit/(:segment)', 'DMViewController::edit/$1');
$routes->post('/fg/create', 'FGDController::create');
$routes->post('/fg/update/(:segment)', 'FGDController::update/$1');
$routes->get('/fg/delete/(:num)', 'DMViewController::delete/$1');

#วังน้อย
$routes->get('/wn', 'WNViewController::index');
$routes->get('/fwg/wnview/(:segment)', 'WNViewController::view/$1');
$routes->get('/fwg/wnhome', 'FGWController::wnhome');
$routes->get('/fwg/dailyView', 'WNViewController::dailyView'); // สำหรับการเข้าหน้าค้นหาหรือดูข้อมูล
$routes->get('/fwg/wnedit/(:segment)', 'WNViewController::edit/$1');
$routes->post('/fwg/create', 'FGWController::create');
$routes->post('/fwg/update/(:segment)', 'FGWController::update/$1');
$routes->get('/fwg/delete/(:num)', 'WNViewController::delete/$1');

#ดอนเมือง
$routes->get('/dfg', 'DFGController::dailyView'); // สำหรับหน้าเริ่มต้นของ DFG
$routes->get('/dfg/dailyView', 'DFGController::dailyView'); // สำหรับการเข้าหน้าค้นหาหรือดูข้อมูล
$routes->get('/dfg/exportExcel', 'DFGController::exportExcel'); // สำหรับการ export ข้อมูล
$routes->post('/dfg/save', 'DFGController::save'); // สำหรับบันทึกข้อมูล
$routes->get('/dfg/delete/(:num)', 'DFGController::delete/$1'); // สำหรับลบข้อมูล โดยใช้ ID ที่ส่งมาผ่าน URL



#วังน้อย
$routes->get('/wfg', 'WFGController::dailyView'); // สำหรับหน้าเริ่มต้นของ DFG
$routes->get('/wfg/dailyView', 'WFGController::dailyView'); // สำหรับการเข้าหน้าค้นหาหรือดูข้อมูล
$routes->get('/wfg/exportExcel', 'WFGController::exportExcel'); // สำหรับการ export ข้อมูล
$routes->post('/wfg/save', 'WFGController::save'); // สำหรับบันทึกข้อมูล
$routes->get('/wfg/delete/(:num)', 'WFGController::delete/$1'); // สำหรับลบข้อมูล โดยใช้ ID ที่ส่งมาผ่าน URL


#Login
$routes->get('/login', 'AuthController::login');
$routes->post('/loginAuth', 'AuthController::loginAuth');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->get('/unauthorized', function () {
    return view('errors/unauthorized'); // สร้างหน้า view นี้เอง
});




