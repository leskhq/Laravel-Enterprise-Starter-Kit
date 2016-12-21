<?php namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use App\Repositories\AuditRepository as Audit;

class DashboardController extends Controller
{
    /**
     * @param Application $app
     * @param Audit $audit
     */
    public function __construct(Application $app, Audit $audit)
    {
        parent::__construct($app, $audit);
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'dashboard']);
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
            ],
            [
                'name' => 'Analyse data',
                'progress' => '37',
                'color' => 'warning'
            ],
        ];

        $page_title = "Dashboard";
        $page_description = "This is the dashboard";

        return view('dashboard', compact('page_title', 'page_description'))->with($data);
    }

}
