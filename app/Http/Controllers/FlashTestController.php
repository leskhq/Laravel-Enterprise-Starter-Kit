<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
class FlashTestController extends Controller
{

    public function success()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with a success level";

        Flash::success('This is a success message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function info()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with an info level";

        Flash::info('This is an info message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function warning()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with a warning level";

        Flash::warning('This is a warning message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }

    public function error()
    {
        $page_title = "Flash test";
        $page_description = "Testing the flash mechanism with a error level";

        Flash::error('This is an error message!');

        return view('flash_test', compact('page_title', 'page_description'));
    }


}
