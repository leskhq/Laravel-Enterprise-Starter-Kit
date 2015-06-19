<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;

class HomeController extends Controller
{

    public function index() {

        $page_title = "Home";
        $page_description = "This is the home page";

        return view('home', compact('page_title', 'page_description'));
    }

}
