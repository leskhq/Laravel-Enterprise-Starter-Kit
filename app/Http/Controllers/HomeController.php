<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {
        $page_title = "Home";
        $page_description = "This is the home page";

        flash('Welcome Aboard!');

        return view('home', compact('page_title', 'page_description'));
    }

}