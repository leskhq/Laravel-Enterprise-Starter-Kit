<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    static public function GetAuditCategory(Audit $audit)
    {
        return trans('general.audit-log.category-show-page');
    }

    static public function GetAuditMessage(Audit $audit)
    {
        $atSymbolPos = strpos($audit->route_action, "@");
        $methodName = substr($audit->route_action, $atSymbolPos);

        switch ($methodName) {
            case "@index":
                $message = trans('general.audit-log.msg-index');
                break;
            default:
                $message = "Unset action in controller";
                break;
        }
        return $message;
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