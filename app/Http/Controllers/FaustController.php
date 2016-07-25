<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Flash;

class FaustController extends Controller
{
    public function index() {

        return view('faust');
    }

}
