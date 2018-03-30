<?php

namespace App\Http\Controllers;
class SystemController extends ApiController
{

    /**
     * Get the system info.
     * 
     * @return mixed
     */
    public function getSystemInfo()
    {
        $responData = [
            'status'=>200
        ];
        try{
            $pdo     = \DB::connection()->getPdo();

            $version = $pdo->query('select version()')->fetchColumn();
            $data = [
                'server'          => $_SERVER['SERVER_SOFTWARE'],
                'http_host'       => $_SERVER['HTTP_HOST'],
                'remote_host'     => isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR'],
                'user_agent'      => $_SERVER['HTTP_USER_AGENT'],
                'php'             => phpversion(),
                'sapi_name'       => php_sapi_name(),
                'extensions'      => implode(", ", get_loaded_extensions()),
                'db_connection'   => isset($_SERVER['DB_CONNECTION']) ? $_SERVER['DB_CONNECTION'] : 'Secret',
                'db_database'     => isset($_SERVER['DB_DATABASE']) ? $_SERVER['DB_DATABASE'] : 'Secret',
                'db_version'      => $version,
            ];

            return $this->response->json($data);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '获取数据失败';
            return $this->response->json(compact('responData'));
        }
    }
}
