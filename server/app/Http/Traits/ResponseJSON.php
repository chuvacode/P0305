<?php


namespace App\Http\Traits;


trait ResponseJSON
{
    // Шаблон ответа в JSON формате
    public function responseJSON($code, $status_text, $data = []) {
        $data = $data != [] ? ['data' => $data] : [];
        return response()
            ->json($data)
            ->setStatusCode($code, $status_text)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, DELETE')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token, Authorization, X-Requested-With, x-xsrf-token');
    }
}
