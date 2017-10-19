<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Repositories\AuditRepository;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataGrid\DataGrid;

class AuditsController extends Controller
{

    /**
     * @var AuditRepository
     */
    protected $audit;

    /**
     * @var UserRepository
     */
    protected $user;


    public function __construct(AuditRepository $auditRepository, UserRepository $userRepository)
    {
        $this->audit = $auditRepository;
        $this->user  = $userRepository;
    }

    /**
     *
     */
    public function index()
    {
        $filter = DataFilter::source(Audit::with(['user']));
        $filter->text('srch', 'Search audit or their associated users.')->scope('freesearch');
        $filter->build();

        $grid = DataGrid::source($filter);


        if (Auth::user()->hasPermission('core.p.audits.read')) {
            $grid->add('{{ link_to_route(\'admin.audits.show\', $user->username, [$id], []) }}', 'User name', '$user->username');
        } else {
            $grid->add('user.username', 'User name', 'user.username');
        }

        $grid->add('method', 'Method', 'method');
        $grid->add('route_action', 'Action', 'route_action');
        $grid->add('created_at', 'Date', 'created_at');

        $grid->orderBy('created_at', 'desc');
        $grid->paginate(20);

        $page_title = trans('admin/audits/general.page.index.title');
        $page_description = trans('admin/audits/general.page.index.description');

        return view('admin.audits.index', compact('filter', 'grid', 'page_title', 'page_description'));


    }

}
