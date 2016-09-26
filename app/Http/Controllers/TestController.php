<?php namespace App\Http\Controllers;

use App\Repositories\AuditRepository as Audit;
use App\Repositories\ReportPermissionsAndRolesByUsersRepository;
use App\Repositories\ReportRoutesRepository;
use App\Repositories\ReportUsersRepository;
use App\User;
use Auth;
use Exception;
use Flash;
use GridEncoder;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function report_users()
    {
        $page_title = "Report users";
        $page_description = "Showing a sample report with the users.";
        $page_message = "";

        return view('report-users', compact('page_title', 'page_description', 'page_message'));
    }

    public function report_users_data(Request $request)
    {
        GridEncoder::encodeRequestedData(new ReportUsersRepository(new User()), $request->all());
    }

    public function report_routes()
    {
        $page_title = "Report routes";
        $page_description = "Showing a sample report with the users.";
        $page_message = "";

        return view('report-routes', compact('page_title', 'page_description', 'page_message'));
    }

    public function report_routes_data(Request $request)
    {
        GridEncoder::encodeRequestedData(new ReportRoutesRepository(), $request->all());
    }

    public function report_perms_and_roles_by_users()
    {
        $page_title = "Report permissions and roles";
        $page_description = "Showing a sample report of the permissions and roles grouped by users.";
        $page_message = "";

        return view('report-perms-and-roles-by-users', compact('page_title', 'page_description', 'page_message'));
    }

    public function report_perms_and_roles_by_users_data(Request $request)
    {
        GridEncoder::encodeRequestedData(new ReportPermissionsAndRolesByUsersRepository(), $request->all());
    }

}
