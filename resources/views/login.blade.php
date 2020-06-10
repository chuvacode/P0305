@extends('layouts.default')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="form_login">
            <div class="first_line d-flex align-items-center">
                <div class="avatar" style="background-image: url({{ asset('fortest/avatar.png') }});"></div>
                <span class="user_name">Чуваков Алексей</span>
            </div>
            <div class="second_line">
                <input type="password" type="text">
            </div>
            <div class="third_line d-flex">
                <a class="button_login">Авторизироваться</a>
            </div>
        </div>
    </div>
@endsection
