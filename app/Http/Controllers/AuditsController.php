<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuditIndexRequest;
use App\Models\Audit;
use App\Repositories\AuditRepository;
use App\Repositories\Criteria\Audits\AuditsCreatedBefore;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;
use Settings;
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
    public function index(AuditIndexRequest $request)
    {

        $purge_retention = Settings::get('audit.purge_retention');

        $filter = DataFilter::source(Audit::with(['user']));
        $filter->text('srch', 'Search audit or their associated users.')->scope('freesearch');
        $filter->build();

        $grid = DataGrid::source($filter);

        // Get all attribute from the request.
        $attributes = $request->all();

        if ((array_has($attributes, 'export_to_csv')) && ("true" == $attributes['export_to_csv'])) {
            $grid->add('id', 'ID');
            $grid->add('user.username', 'User name');
            $grid->add('method', 'Method');
            $grid->add('path', 'Path');
            $grid->add('route_name', 'Route name');
            $grid->add('route_action', 'Route action');
            $grid->add('query', 'Query');
            $grid->add('data', 'Data');
            $grid->add('userAgent', 'User agent');
            $grid->add('device', 'Device');
            $grid->add('platform', 'Platform');
            $grid->add('browser', 'Browser');
            $grid->add('isDesktop', 'Is desktop');
            $grid->add('isMobile', 'Is mobile');
            $grid->add('isPhone', 'Is phone');
            $grid->add('isTablet', 'Is tablet');
            $grid->add('created_at', 'Create at');
            $grid->add('updated_at', 'Updated at');

            return $grid->buildCSV('export-audits_', 'Y-m-d.His');

        } else {

            if (Auth::user()->hasPermission('core.p.audits.read')) {
                $grid->add('{{ ($user)?link_to_route(\'admin.audits.show\', $user->username, [$id], []):"" }}', 'User name', '$user->username');
                $grid->add('{{ ($method)?link_to_route(\'admin.audits.show\', $method, [$id], []):"" }}', 'Method', 'method');
                $grid->add('{{ ($route_action)?link_to_route(\'admin.audits.show\', $route_action, [$id], []):"" }}', 'Action', 'route_action');
                $grid->add('{{ ($query)?link_to_route(\'admin.audits.show\', $query, [$id], []):"" }}', 'Query', 'query');
                $grid->add('{{ ($data)?link_to_route(\'admin.audits.show\', $data, [$id], []):"" }}', 'Data', 'data');
                $grid->add('{{ ($created_at)?link_to_route(\'admin.audits.show\', $created_at, [$id], []):"" }}', 'Date', 'created_at');
            } else {
                $grid->add('user.username', 'User name', 'user.username');
                $grid->add('method', 'Method', 'method');
                $grid->add('route_action', 'Action', 'route_action');
                $grid->add('query', 'Query', 'query');
                $grid->add('data', 'Data', 'data');
                $grid->add('created_at', 'Date', 'created_at');
            }


            $grid->orderBy('created_at', 'desc');
            $grid->paginate(20);

            $page_title = trans('admin/audits/general.page.index.title');
            $page_description = trans('admin/audits/general.page.index.description');

            return view('admin.audits.index', compact('filter', 'grid', 'purge_retention', 'page_title', 'page_description'));
        }

    }

    public function getModalPurge(Request $request)
    {
        $error = null;

        $purge_retention = Settings::get('audit.purge_retention');
        $modal_title = trans('admin/audits/dialog.purge.title');
        $modal_href = route('admin.audits.purge');
        $modal_onclick = "";
        $modal_body = trans('admin/audits/dialog.purge.body', ['retention_period' => $purge_retention]);

        return view('modal_confirmation', compact('error', 'modal_href', 'modal_onclick', 'modal_title', 'modal_body'));

    }

    public function purge()
    {
        $purge_retention = Settings::get('audit.purge_retention');
        $purge_date = (new \DateTime())->modify("- $purge_retention day");
        $auditsToDelete = $this->audit->pushCriteria(new AuditsCreatedBefore($purge_date))->all();

        foreach( $auditsToDelete as $audit) {
            $this->audit->delete($audit->id);
        }

        return \Redirect::route('admin.audits.index');
    }

    public function show($id)
    {
        $data_view = "";

        $audit = $this->audit->find($id);
        $atSymbolPos = strpos($audit->route_action, "@");
        $data_parser = substr_replace($audit->route_action, "::auditViewer", $atSymbolPos);

        $isCallable = is_callable($data_parser, false, $callable_name);
        if ($isCallable) {
            $dataArray = call_user_func($data_parser, $audit);

            $data_view_name = "admin/audits/_audit_log_data_viewer_default";
            if (array_key_exists('show_partial', $dataArray)){
                $data_view_name = $dataArray['show_partial'];
                $dataArray = array_except($dataArray, 'show_partial');
            }

            if (($data_view_name) && (\View::exists($data_view_name))) {
                $data_view = \View::make($data_view_name, compact('dataArray'));
            }
        }
        else {
            $dataArray = json_decode($audit->data, true);

            $data_view_name = "admin/audits/_audit_log_data_viewer_default";
            $data_view = \View::make($data_view_name, compact('dataArray'));
        }

        $page_title = trans('admin/audits/general.page.show.title');
        $page_description = trans('admin/audits/general.page.show.description', ['name' => $audit->name]); // "Displaying audit log entry";

        return view('admin.audits.show', compact('audit', 'data_view', 'page_title', 'page_description'));
    }

}
