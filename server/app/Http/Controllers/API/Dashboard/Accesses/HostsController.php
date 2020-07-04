<?php

namespace App\Http\Controllers\API\Dashboard\Accesses;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseJSON;
use App\Models\AccessHost;
use App\Models\LinkSiteToHost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class HostsController extends Controller
{

    // Подключаем конструктор ответов в JSON формате
    use ResponseJSON;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isShort = $request->query('short', false);
        if ($isShort) {
            $hosts = AccessHost::select(['id', 'title', 'host_login'])->get();
        } else {
            $hosts = AccessHost::all();
        }

        return $this->responseJSON(200, 'OK', [ 'content' => $hosts->toArray() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        $AccessHost = AccessHost::create($data);

        return $AccessHost;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Извлекаем полученные данные
        $data = $request->all();

        // Проверяем полученные данные
        $validator = Validator::make($data, [
            'title' => 'required|max:50',
            'link_sign_in' => 'required|max:255',
            'host_login' => 'required|max:30',
            'host_password' => 'required|max:255',
            'ftp_server' => 'nullable|max:30',
            'ftp_login' => 'nullable|max:30',
            'ftp_password' => 'nullable|max:255',
            'comment' => 'nullable|max:255'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        // Добавление в БД и получение добавленного экземпляра
        $AccessHost = $this->create($data);

        return $this->responseJSON(201, 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($host = AccessHost::find($id)) {
            return $this->responseJSON(200, 'Success found', [
                'content' => $host->toArray()
            ]);
        }

        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($host = AccessHost::find($id)) {
            return $this->responseJSON(200, 'Success found', [
               'content' => $host->toArray()
            ]);
        }

        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $host = AccessHost::find($id);

        if ( $host === null ) return $this->responseJSON(404, 'Not found');

        $data = $request->all();

        // Проверяем полученные данные
        $validator = Validator::make($data, [
            'title' => 'nullable|max:50',
            'link_sign_in' => 'nullable|max:255',
            'host_login' => 'nullable|max:30',
            'host_password' => 'nullable|max:255',
            'ftp_server' => 'nullable|max:30',
            'ftp_login' => 'nullable|max:30',
            'ftp_password' => 'nullable|max:255',
            'comment' => 'nullable|max:255'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        $host->update($data);

        return $this->responseJSON(200, 'OK', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessHost  $accessHost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$host = AccessHost::find($id))
            return $this->responseJSON(404, 'Not found');

        // Удаление связей
        if (($links = LinkSiteToHost::where('host_id', $host->id)->get())->toArray() !== []) {
            foreach ($links as $key => $link) {
                $link->delete();
            }
        }

        if ($host->delete())
            return $this->responseJSON(204, 'Success destroy');

        return $this->responseJSON(501, 'Not implemented');
    }
}
