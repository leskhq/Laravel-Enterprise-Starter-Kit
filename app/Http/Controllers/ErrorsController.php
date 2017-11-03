<?php

namespace App\Http\Controllers;

use App\Events\ErrorsPurged;
use App\Events\ErrorsPurging;
use App\Http\Requests\ErrorIndexRequest;
use App\Models\Error;
use App\Repositories\Criteria\Errors\ErrorsCreatedBefore;
use App\Repositories\ErrorRepository;
use Auth;
use Illuminate\Http\Request;
use Settings;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataGrid\DataGrid;

class ErrorsController extends Controller
{

    /**
     * @var ErrorRepository
     */
    protected $error;


    public function __construct(ErrorRepository $errorRepository)
    {
        $this->error         = $errorRepository;
    }

    /**
     * @param ErrorIndexRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ErrorIndexRequest $request)
    {

        $purge_retention = Settings::get('error.purge_retention');

        $filter = DataFilter::source(Error::with(['user']));
        $filter->text('srch', 'Search error or their associated users.')->scope('freesearch');
        $filter->build();

        $grid = DataGrid::source($filter);

        // Get all attribute from the request.
        $attributes = $request->all();

        if ((array_has($attributes, 'export_to_csv')) && ("true" == $attributes['export_to_csv'])) {
            $grid->add('id', 'ID');
            $grid->add('user.username', 'User name');
            $grid->add('class', 'Class');
            $grid->add('file', 'File');
            $grid->add('code', 'Code');
            $grid->add('status_code', 'Status code');
            $grid->add('line', 'Line');
            $grid->add('message', 'Message');
            $grid->add('trace', 'Trace');
            $grid->add('flatdata', 'Data');
            $grid->add('url', 'URL');
            $grid->add('method', 'Method');
            $grid->add('created_at', 'Create at');
            $grid->add('updated_at', 'Updated at');

            return $grid->buildCSV('export-errors_', 'Y-m-d.His');

        } else {

            if (Auth::user()->hasPermission('core.p.errors.read')) {
                $grid->add('{{ ($created_at)?link_to_route(\'admin.errors.show\', $created_at, [$id], []):"" }}', 'Date', 'created_at');
                $grid->add('{{ ($class)?link_to_route(\'admin.errors.show\', $class, [$id], []):"" }}', 'Class', 'class');
                $grid->add('{{ ($url)?link_to_route(\'admin.errors.show\', $url, [$id], []):"" }}', 'URL', 'url');
                $grid->add('{{ ($message)?link_to_route(\'admin.errors.show\', $message, [$id], []):"" }}', 'Message', 'message');
                $grid->add('{{ ($user)?link_to_route(\'admin.errors.show\', $user->username, [$id], []):"" }}', 'User name', '$user->username');
            } else {
                $grid->add('created_at', 'Date', 'created_at');
                $grid->add('class', 'Class', 'class');
                $grid->add('url', 'URL', 'url');
                $grid->add('message', 'Message', 'message');
                $grid->add('user.username', 'User name', 'user.username');
            }


            $grid->orderBy('created_at', 'desc');
            $grid->paginate(20);

            $page_title = trans('admin/errors/general.page.index.title');
            $page_description = trans('admin/errors/general.page.index.description');

            return view('admin.errors.index', compact('filter', 'grid', 'purge_retention', 'page_title', 'page_description'));
        }

    }

    public function getModalPurge(Request $request)
    {
        $error = null;

        $purge_retention = Settings::get('errors.purge_retention');
        $modal_title = trans('admin/errors/dialog.purge.title');
        $modal_href = route('admin.errors.purge');
        $modal_onclick = "";
        $modal_body = trans('admin/errors/dialog.purge.body', ['retention_period' => $purge_retention]);

        return view('modal_confirmation', compact('error', 'modal_href', 'modal_onclick', 'modal_title', 'modal_body'));

    }

    public function purge()
    {

        $purge_retention = Settings::get('errors.purge_retention');
        $purge_date = (new \DateTime())->modify("- $purge_retention day");
        $errorsToDelete = $this->error->pushCriteria(new ErrorsCreatedBefore($purge_date))->all();

        event(new ErrorsPurging($errorsToDelete));

        foreach( $errorsToDelete as $error) {
            $this->error->delete($error->id);
        }

        event(new ErrorsPurged());

        return \Redirect::route('admin.errors.index');
    }

    public function show($id)
    {
        $error = $this->error->with(['user'])->find($id);

        $page_title = trans('admin/errors/general.page.show.title');
        $page_description = trans('admin/errors/general.page.show.description', ['name' => $error->name]); // "Displaying error log entry";

        return view('admin.errors.show', compact('error', 'page_title', 'page_description'));
    }

}
