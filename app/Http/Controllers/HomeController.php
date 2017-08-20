<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {
        $page_title = "Home";
        $page_description = "This is the home page";

        return view('home', compact('page_title', 'page_description'));
    }

    public function welcome(Request $request)
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

//        $request->flashExcept(['password', 'password_confirmation']);
        $request->session()->reflash();
        return view('welcome', compact('page_title', 'page_description'));
    }

}