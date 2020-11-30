<?php

namespace App\Http\Controllers\API\Security;

use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseJSON;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;

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
        // Извлекаем полученные данные
        $data = $request->all();

        // Проверяем полученные данные
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:8,50|confirmed'
        ]);

        // Проверяем результат валидации
        if ($validator->fails()) {
            $errors = array_map(function ($error) {
                return is_array($error) ? $error[0] : $error;
            }, $validator->errors()->toArray());

            return $this->responseJSON(422, 'Unprocessable entity', $errors);
        }

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $this->responseJSON(201, 'Success');
    }

    public function login(Request $request)
    {
        // Извлекаем данные
        $data = $request->all();

        // Проверяем существует ли пользователь с указанным email адресом
        $user = User::whereEmail($data['username'])->first();

        if (!$user) {
            return $this->responseJSON(422, 'Unprocessable Entity', [
                'message' => 'Wrong email or password',
            ]);
        }

        // Если пользователь с таким email адресом найден - проверим совпадает
        // ли его пароль с указанным
        if (!Hash::check(request('password'), $user->password)) {
            return $this->responseJSON(422, 'Unprocessable Entity', [
                'message' => 'Wrong email or password',
            ]);
        }

        // Внутренний API запрос для получения токенов
        $client = \DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        // Убедимся, что Password Client существует в БД (т.е. Laravel Passport
        // установлен правильно)
        if (!$client) {
            return $this->responseJSON(500, 'Internal Server Error', [
                'message' => 'php artisan passport:install is not setup properly',
            ]);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $data['username'],
            'password' => $data['password'],
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return $this->responseJSON(422, 'Unprocessable Entity', [
                'message' => 'Wrong email or password',
            ]);
        }

        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent());

        // Формируем окончательный ответ в нужном формате
        return $this->responseJSON(200, 'Success', [
            'token' => $data->access_token,
            'user' => $user,
        ]);

//        $client = \DB::table('oauth_clients')
//            ->where('password_client', true)
//            ->first();
//        $data = [
//            'grant_type' => 'password',
//            'client_id' => $client->id,
//            'client_secret' => $client->secret,
//            'username' => $request['username'],
//            'password' => $request['password']
//        ];
//
//        $request = Request::create('/oauth/token', 'POST', $data);
//
//        return app()->handle($request);

//        $this->validate($request, [
//            'email' => 'required|email',
//            'password' => 'required|between:8,50',
//        ]);
//
//        $user = User::whereEmail($request->email)->first();
//
//        if (!($user && Hash::check($request->password, $user->password))) {
//            return $this->responseJSON(422, 'Error', [
//                'success' => false,
//            ]);
//        }
//
//        $user->api_token = str_random(60);
//        $user->save();
//
//        return $this->responseJSON(200, 'Success', [
//            'success' => true,
//            'user_id' => $user->id,
//            'api_token' => $user->api_token,
//            'name' => $user->name
//        ]);
    }

    public function logout(Request $request)
    {
        $accessToken = auth()->user()->token();

        $refreshToken = \DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return $this->responseJSON(200, 'Success');
    }

    public function getUser() {
        return auth()->user();
    }

    public function index(Request $request) {
        $users = User::select(['id', 'name', 'email', 'avatar_url'])->get();
        return $this->responseJSON(200, 'OK', ['content' => $users->toArray() ]);
    }
}
