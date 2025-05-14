<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\HTTP\CURLRequest;
use Config\Services;

class SendDailyLink extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'link:senddaily';
    protected $description = 'Send daily link to API for auto mail.';

    public function run(array $params)
    {
        $client = Services::curlrequest();

        $url = 'https://uat-api-mservice.sprinkle-th.work/mail/send';

        $today = date('Y-m-d');

        $data = [
            'to'       => 'chonlakorn.pun@gmail.com',
            'subject'  => 'Daily Auto Link',
            'file'     => null, 
            'body'     => 'Please check the daily report at: <a href="http://localhost:80/FG-Stock/index.php/fg/dmview/' . $today . '">Report Link</a>',
            'project'  => 'FG Stock',
            'username' => 'system_auto'
        ];

        try {
            $response = $client->post($url, [
                'headers' => [

                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $data,
                'auth' => ['mwater', 'P@s$w0rdu8i9']
            ]);

            if ($response->getStatusCode() == 200) {
                CLI::write('Auto email sent successfully.', 'green');
            } else {
                CLI::error('Failed to send email. Status: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            CLI::error('Exception: ' . $e->getMessage());
        }
    }
}
