<?php

namespace App\Http\Controllers\API\Dashboard\Accesses;

use App\Http\Controllers\Controller;
use App\Http\Traits\Crypter;
use App\Http\Traits\ResponseJSON;
use Illuminate\Http\Request;
use App\Models\AccessOther;
use Illuminate\Support\Facades\Validator;

class OthersController extends Controller
{
    use ResponseJSON;
    use Crypter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isShort = $request->query('short', false);
        if ($isShort) {
            $others = AccessOther::select(['id', 'title'])->get();
        } else {
            $others = AccessOther::all();
        }

        $others = $this->decryptCollection($others);

        return $this->responseJSON(200, 'OK', [ 'content' => $others->toArray() ]);
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
            'link_sign_in' => 'required|max:255',
            'login' => 'required|max:30',
            'password' => 'required|max:255',
            'email' => 'nullable|max:30',
            'phone' => 'nullable|max:30',
            'comment' => 'nullable|max:255'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        // Шифрование
        $data = $this->encryptCollection($data);

        // Добавление в БД и получение добавленного экземпляра
        $AccessOther = AccessOther::create($data);

        return $this->responseJSON(201, 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($other = AccessOther::where('id', $id)->get()) {
            return $this->responseJSON(200, 'Success found', [
                'content' => $this->decryptCollection($other)->toArray()[0]
            ]);
        }

        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($other = AccessOther::where('id', $id)->get()) {
            return $this->responseJSON(200, 'Success found', [
                'content' => $this->decryptCollection($other)->toArray()[0]
            ]);
        }

        return $this->responseJSON(404, 'Not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $other = AccessOther::find($id);
        if ( $other === null ) return $this->responseJSON(404, 'Not found');

        // Извлекаем полученные данные
        $data = $request->all();

        // Проверяем полученные данные
        $validator = Validator::make($data, [
            'title' => 'nullable|max:50',
            'link_sign_in' => 'nullable|max:255',
            'login' => 'nullable|max:30',
            'password' => 'nullable|max:255',
            'email' => 'nullable|max:30',
            'phone' => 'nullable|max:30',
            'comment' => 'nullable|max:255'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        // Шифрование
        $data = $this->encryptCollection($data);

        $other->update($data);

        return $this->responseJSON(200, 'OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Если не удалось найти ресурс в БД
        if (!$other = AccessOther::find($id))
            return $this->responseJSON(404, 'Not found');

        // Удаление сайта
        if ($other->delete())
            return $this->responseJSON(204, 'Success destroy');

        // Неизвестная ошибка
        return $this->responseJSON(501, 'Not implemented');
    }
}
