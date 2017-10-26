<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static public function auditViewer(Audit $audit)
    {
        $dataArray = json_decode($audit->data, true);

        $atSymbolPos = strpos($audit->route_action, "@");
        $data_parser = substr_replace($audit->route_action, "::", $atSymbolPos, 1) . "AuditViewer";

        $dataArray['show_partial'] =  "admin/audits/_audit_log_data_viewer_default";

        $isCallable = is_callable($data_parser, false, $callable_name);
        if ($isCallable) {
            $dataArray = call_user_func($data_parser, $audit, $dataArray);
        }

        return $dataArray;

    }

}
