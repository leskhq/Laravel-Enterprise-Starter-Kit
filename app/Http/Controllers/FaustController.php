<?php namespace App\Http\Controllers;


use App\Models\Audit;

class FaustController extends Controller
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
                $message = trans('general.audit-log.msg-faust');
                break;
            default:
                $message = "Unset action in controller";
                break;
        }
        return $message;
    }

    public function index()
    {
        return view('faust');
    }

}
