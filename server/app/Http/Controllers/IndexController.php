<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        if (true) { // Auth::check()
            return redirect('/Dashboard');
        }

        return view('login');
    }
}
