<?php

namespace App\Http\Controllers\API\Security;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseJSON;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    use ResponseJSON;

    public function __construct()
    {
        $this->middleware('auth:api')
            ->only('logout');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:8,50|confirm',
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->responseJSON(200, 'Success', [
            'success' => true
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:8,50',
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!($user && Hash::check($request->password, $user->password))) {
            return $this->responseJSON(422, 'Error', [
                'success' => false,
            ]);
        }

        $user->api_token = str_random(60);
        $user->save();

        return $this->responseJSON(200, 'Success', [
            'success' => true,
            'user_id' => $user->id,
            'api_token' => $user->api_token,
            'name' => $user->name
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();

        return $this->responseJSON(200, 'Success', [
            'success' => true,
        ]);
    }
}
