<?php

namespace App\Http\Controllers\API\Dashboard\Accesses;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseJSON;
use App\Models\AccessSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SitesController extends Controller
{

    use ResponseJSON;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = AccessSite::all();

        return $this->responseJSON(200, 'Success', [
            'availables' => $sites
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'site_url' => 'required|max:255',
            'admin_panel_url' => 'required|max:255',
            'admin_panel_login' => 'required|max:30',
            'admin_panel_password' => 'required|max:255',
            'ftp_server' => 'nullable|max:30',
            'ftp_login' => 'nullable|max:30',
            'ftp_password' => 'nullable|max:255',
            'db_name' => 'nullable|max:30',
            'db_login' => 'nullable|max:30',
            'db_password' => 'nullable|max:255',
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
        $AccessHost = AccessSite::create($data);

        return $this->responseJSON(201, 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessSite  $accessSite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($host = AccessSite::find($id)) {
            return $this->responseJSON(200, 'Success found', [
                'content' => $host->toArray()
            ]);
        }

        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessSite  $accessSite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($host = AccessSite::find($id)) {
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
     * @param  \App\Models\AccessSite  $accessSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessSite $accessSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessSite  $accessSite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$host = AccessSite::find($id))
            return $this->responseJSON(404, 'Not found');

        if ($host->delete())
            return $this->responseJSON(204, 'Success destroy');

        return $this->responseJSON(501, 'Not implemented');
    }
}
