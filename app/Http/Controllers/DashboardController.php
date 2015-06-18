<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Create a new dashboard controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Protect all dashboard routes. Users must be authenticated.
        $this->middleware('auth');
    }

    public function index() {
        $data['tasks'] = [
            [
                'name' => 'Design New Dashboard',
                'progress' => '87',
                'color' => 'danger'
            ],
            [
                'name' => 'Create Home Page',
                'progress' => '76',
                'color' => 'warning'
            ],
            [
                'name' => 'Some Other Task',
                'progress' => '32',
                'color' => 'success'
            ],
            [
                'name' => 'Start Building Website',
                'progress' => '56',
                'color' => 'info'
            ],
            [
                'name' => 'Develop an Awesome Algorithm',
                'progress' => '10',
                'color' => 'success'
            ]
        ];

        $page_title = "Dashboard";
        $page_description = "This is the dashboard";

        return view('dashboard', compact('page_title', 'page_description'))->with($data);
    }

}
