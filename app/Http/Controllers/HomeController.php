<?php namespace App\Http\Controllers;

use App\Repositories\AuditRepository as Audit;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Redirect;
use Setting;

class HomeController extends Controller
{
    /**
     * @param Application $app
     * @param Audit $audit
     */
    public function __construct(Application $app, Audit $audit)
    {
        parent::__construct($app, $audit);
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'home']);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $homeRouteName = 'welcome';

        try {
            $homeCandidateName = Setting::get('app.home_route');
            $homeRouteName = $homeCandidateName;
        }
        catch (Exception $ex) { } // Eat the exception will default to the welcome route.

        $request->session()->reflash();
        return Redirect::route($homeRouteName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

//        $request->flashExcept(['password', 'password_confirmation']);
        $request->session()->reflash();
        return view('welcome', compact('page_title', 'page_description'));
    }

}
