<?php


namespace App\Http\Traits;


trait ResponseJSON
{
    // Шаблон ответа в JSON формате
    public function responseJSON($code, $status_text, $data = []) {
        $data = $data != [] ? ['data' => $data] : [];
        return response()
            ->json($data)
            ->setStatusCode($code, $status_text);
    }
}
