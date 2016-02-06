<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestMenusController extends Controller
{

    public function test_menu_home()
    {
        $page_title = "Test Menus";
        $page_description = "Home for the menus test pages.";

        return view('test_menus', compact('page_title', 'page_description'));
    }

    public function test_menu_one()
    {
        $page_title = "Menu One";
        $page_description = "Test menu one page.";

        return view('test_menus', compact('page_title', 'page_description'));
    }

    public function test_menu_two()
    {
        $page_title = "Menu Two";
        $page_description = "Test menu two page.";

        return view('test_menus', compact('page_title', 'page_description'));
    }

    public function test_menu_two_a()
    {
        $page_title = "Menu Two A";
        $page_description = "Test menu two A page.";

        return view('test_menus', compact('page_title', 'page_description'));
    }

    public function test_menu_two_b()
    {
        $page_title = "Menu Two B";
        $page_description = "Test menu two B page.";

        return view('test_menus', compact('page_title', 'page_description'));
    }

    public function test_menu_three()
    {
        $page_title = "Menu Three";
        $page_description = "Test menu Three page.";

        return view('test_menus', compact('page_title', 'page_description'));
    }

}
