<?php

namespace App\Http\Controllers\API\Dashboard\Accesses;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseJSON;
use App\Models\AccessSite;
use App\Models\LinkSiteToHost;
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
        $host_id = $data['host'];
        unset($data['host']);

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

        // Создание связи, если выбран хостинг
        if ($host_id !== null) {
            LinkSiteToHost::create([
                'site_id' => $AccessHost->id,
                'host_id' => $host_id
            ]);
        }

        return $this->responseJSON(201, 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessSite  $accessSite
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($site = AccessSite::where('id', $id)->with('host.host')->get()) {
            return $this->responseJSON(200, 'Success found', [
                'content' => $site->toArray()[0]
            ]);
        }

        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Get linked host
     */
    public function getLinkedHost($id)
    {
//        if ($host = AccessSite::find($id)->host()) {
//            return $this->responseJSON(200, 'Success found', [
//                'content' => $host->toArray()
//            ]);
//        }
//
//        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessSite  $accessSite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($site = AccessSite::where('id', $id)->with('host.host')->get()) {
            return $this->responseJSON(200, 'Success found', [
                'content' => $site->toArray()[0]
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
    public function update(Request $request, $id)
    {
        $site = AccessSite::find($id);
        if ( $site === null ) return $this->responseJSON(404, 'Not found');

        // Извлекаем полученные данные
        $data = $request->all();
        $host_id = null;

        if (isset($data['host'])) {
            $host_id = $data['host'];
            unset($data['host']);
        }

        // Проверяем полученные данные
        $validator = Validator::make($data, [
            'title' => 'max:50',
            'site_url' => 'max:255',
            'admin_panel_url' => 'max:255',
            'admin_panel_login' => 'max:30',
            'admin_panel_password' => 'max:255',
            'ftp_server' => 'max:30',
            'ftp_login' => 'max:30',
            'ftp_password' => 'max:255',
            'db_name' => 'max:30',
            'db_login' => 'max:30',
            'db_password' => 'max:255',
            'comment' => 'max:255'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        $site->update($data);

        // Создание связи, если выбран хостинг
        if ($host_id !== null && $host_id !== "null") {
            // Если запись существует, обнавляет
            $host_link = LinkSiteToHost::where('site_id', $site->id)->get();
            if ($host_link->toArray() !== []) {
                $host_link = $host_link[0];
                $host_link->host_id = (int)$host_id;
                $host_link->save();
            } else {
                LinkSiteToHost::create([
                    'site_id' => $site->id,
                    'host_id' => $host_id
                ]);
            }
        } else {
            // Если запись существует, удаляем
            $host_link = LinkSiteToHost::where('site_id', $site->id)->get();
            if ($host_link->toArray() !== []) {
                $host_link = $host_link[0];
                $host_link->delete();
            }
        }

        return $this->responseJSON(200, 'OK');
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
