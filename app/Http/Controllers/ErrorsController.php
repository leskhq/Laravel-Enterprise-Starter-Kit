<?php namespace App\Http\Controllers;

use App\Repositories\AuditRepository as Audit;
use App\Repositories\Criteria\Error\ErrorByCreatedDateDescending;
use App\Repositories\Criteria\Error\ErrorCreatedBefore;
use App\Repositories\Criteria\Error\ErrorsWithUsers;
use App\Repositories\ErrorRepository as Error;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Setting;

class ErrorsController extends Controller {

    /**
     * @var Error
     */
    private $error;

    /**
     * @param Route $route
     * @param Permission $permission
     */
    public function __construct(Application $app, Audit $audit, Error $error)
    {
        parent::__construct($app, $audit);
        $this->error = $error;
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'error']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Audit::log(Auth::user()->id, trans('admin/error/general.audit-log.category'), trans('admin/error/general.audit-log.msg-index'));

        $page_title = trans('admin/error/general.page.index.title');
        $page_description = trans('admin/error/general.page.index.description');
        $purge_retention = Setting::get('errors.purge_retention');

        $lern_errors = $this->error->pushCriteria(new ErrorByCreatedDateDescending())->pushCriteria(new ErrorsWithUsers())->paginate(20);

        return view('admin.errors.index', compact('lern_errors', 'purge_retention', 'page_title', 'page_description'));
    }

    public function purge()
    {
        Audit::log(Auth::user()->id, trans('admin/error/general.audit-log.category'), trans('admin/error/general.audit-log.msg-purge'));

        $purge_retention = Setting::get('errors.purge_retention');
        $purge_date = (new \DateTime())->modify("- $purge_retention day");
        $errorsToDelete = $this->error->pushCriteria(new ErrorCreatedBefore($purge_date))->all();

        foreach( $errorsToDelete as $error) {
            // The AuditRepository located at $this->error is changed to a instance of the
            // QueryBuilder when we run a query as done above. So we had to revert to some
            // Magic to get a handle of the model...
//            $this->error->delete($error->id);
            $this->app->make($this->error->model())->destroy($error->id);
        }

        return \Redirect::route('admin.errors.index');
    }

    public function show($id)
    {
        $error = $this->error->find($id);

        Audit::log(Auth::user()->id, trans('admin/error/general.audit-log.category'), trans('admin/error/general.audit-log.msg-show'));

        $errorData = urldecode(http_build_query($error->data, '', PHP_EOL));

        $page_title = trans('admin/error/general.page.show.title');
        $page_description = trans('admin/error/general.page.show.description', ['error_id' => $error->id]);

        return view('admin.errors.show', compact('error', 'errorData', 'page_title', 'page_description'));
    }

}