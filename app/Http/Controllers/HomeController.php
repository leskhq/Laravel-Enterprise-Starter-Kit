<?php namespace App\Http\Controllers;

use App\Models\Setting;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $homeRouteName = 'welcome';

        try {
            $homeCandidateName = (new Setting())->get('app.home_route');
            $homeRouteName = $homeCandidateName;
        }
        catch (\Exception $ex) { } // Eat the exception will default to the welcome route.

        return \Redirect::route($homeRouteName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome()
    {
        $page_title = trans('general.text.welcome');
        $page_description = "This is the welcome page";

        return view('welcome', compact('page_title', 'page_description'));
    }

}
