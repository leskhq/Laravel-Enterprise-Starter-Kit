<?php namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $homeRouteName = 'welcome';

        try {
            $homeCandidateName = config('app.home_route');
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
        $page_title = "Welcome";
        $page_description = "This is the welcome page";

        return view('welcome', compact('page_title', 'page_description'));
    }

}
