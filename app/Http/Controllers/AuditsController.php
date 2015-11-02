<?php namespace App\Http\Controllers;

use App\Repositories\AuditRepository as Audit;
use App\Repositories\Criteria\Audit\AuditByCreatedDateDescending;
use App\Repositories\Criteria\Audit\AuditCreatedBefore;
use Illuminate\Container\Container as App;
use Auth;

class AuditsController extends Controller {

    /**
     * @var Audit
     */
    private $audit;

    /**
     * @var App
     */
    private $app;

    /**
     * @param Route $route
     * @param Permission $permission
     */
    public function __construct(App $app, Audit $audit)
    {
        $this->app = $app;
        $this->audit = $audit;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Audit::log(Auth::user()->id, trans('admin/audit/general.audit-log.category'), trans('admin/audit/general.audit-log.msg-index'));

        $page_title = trans('admin/audit/general.page.index.title');
        $page_description = trans('admin/audit/general.page.index.description');
        $purge_retention = config('audit.purge_retention');

        $audits = $this->audit->pushCriteria(new AuditByCreatedDateDescending())->paginate(20);

        return view('admin.audit.index', compact('audits', 'purge_retention', 'page_title', 'page_description'));
    }

    public function purge()
    {
        Audit::log(Auth::user()->id, trans('admin/audit/general.audit-log.category'), trans('admin/audit/general.audit-log.msg-purge'));

        $purge_retention = config('audit.purge_retention');
        $purge_date = (new \DateTime())->modify("- $purge_retention day");
        $auditsToDelete = $this->audit->pushCriteria(new AuditCreatedBefore($purge_date))->all();

        foreach( $auditsToDelete as $audit) {
            // The AuditRepository located at $this->audit is changed to a instance of the
            // QueryBuilder when we run a query as done above. So we had to revert to some
            // Magic to get a handle of the model...
//            $this->audit->delete($audit->id);
            $this->app->make($this->audit->model())->destroy($audit->id);
        }

        return \Redirect::route('admin.audit.index');
    }

    public function replay($id)
    {
        Audit::log(Auth::user()->id, trans('admin/audit/general.audit-log.category'), trans('admin/audit/general.audit-log.msg-replay', ['ID' => $id]));

        $audit = $this->audit->find($id);

        return \Redirect::route($audit->action, ["id" => $id]);
    }

    // TODO: Implement function show to display more details, including data field.
}