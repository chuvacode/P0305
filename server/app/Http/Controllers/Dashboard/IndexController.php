<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Access\AccessHostController;
use Illuminate\Http\Request;
use App\Models\AccessHost;

class IndexController extends Controller
{
    function host() {
        $accesses = AccessHost::select(['name', 'host_login', 'host_password', 'ftp_server', 'ftp_login', 'ftp_password', 'comment'])->get();
        return view('Dashboard.access.host', compact('accesses'));
    }

    function site() {
        $accesses = AccessHost::select(['name', 'host_login', 'host_password', 'ftp_server', 'ftp_login', 'ftp_password', 'comment'])->get();
        return view('Dashboard.access.site', compact('accesses'));
    }

    function other() {
        $accesses = AccessHost::select(['name', 'host_login', 'host_password', 'ftp_server', 'ftp_login', 'ftp_password', 'comment'])->get();
        return view('Dashboard.access.other', compact('accesses'));
    }

    function report() {
        $accesses = AccessHost::select(['name', 'host_login', 'host_password', 'ftp_server', 'ftp_login', 'ftp_password', 'comment'])->get();
        return view('Dashboard.report.home', compact('accesses'));
    }

    function getMenu() {

        $menu = [
            'Доступы' => [
                'url' => null,
                'open' => 'true',
                'childs' => [
                    'Хостинги' => ['url' => route('dashboard.host')],
                    'Сайты' => ['url' => route('dashboard.site')],
                    'Другое' => ['url' => route('dashboard.other')]
                ]
            ],
            'Отчеты' => [
                'url' => route('dashboard.report'),
                'childs' => null
            ]
        ];

        return $menu;
    }
}
