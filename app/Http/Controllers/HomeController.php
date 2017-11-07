<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class HomeController extends Controller
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
                $message = trans('admin/errors/general.audit-log.msg-index');
                break;
            case "@welcome":
                $message = trans('admin/errors/general.audit-log.msg-welcome');
                break;
            default:
                $message = "Unset action in controller";
                break;
        }
        return $message;
    }


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