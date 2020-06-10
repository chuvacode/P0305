@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid container_access w-100">
        <div class="panel_line">
            <h3>Хостинги</h3>
            <div class="right ml-auto">
                <div class="search">
                    <input v-model="search" type="text">
                    <a href="#"></a>
                </div>
                <a id="add_new_host" class="button-1 ml-30" href="#">Добавить</a>
            </div>
        </div>

        <accesses-host :accesses="{{ json_encode($accesses) }}" :search="search"></accesses-host>
    </div>
@endsection
