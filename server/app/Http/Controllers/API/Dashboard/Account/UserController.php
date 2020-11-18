<?php

namespace App\Http\Controllers\API\Dashboard\Account;

use App\Http\Controllers\Controller;
use App\Http\Traits\Crypter;
use App\Http\Traits\ResponseJSON;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $users = User::all();
//        $users = $this->decryptCollection($users);
        return $this->responseJSON(200, 'OK', [ 'content' => $users->toArray() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|max:50',
            'password' => 'required|max:255',
            'email' => 'required|max:50',
            'privilege' => 'required|max:50'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        // Добавление в БД и получение добавленного экземпляра
        $user = User::create($data);

        return $this->responseJSON(201, 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
