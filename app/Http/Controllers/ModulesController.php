<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\AuditRepository as Audit;
use Artisan;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Sroutier\LESKModules\Facades\Module;

class ModulesController extends Controller
{
    /**
     * @param Application $app
     * @param Audit $audit
     */
    public function __construct(Application $app, Audit $audit)
    {
        parent::__construct($app, $audit);
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'modules']);
    }


    /**
     * Display the list of modules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-index'));

        $page_title = trans('admin/modules/general.page.index.title');
        $page_description = trans('admin/modules/general.page.index.description');

        // Get all Modules
        $modules = Module::all();
        // Sort by order then by name.
        $modules = $modules->sort(function($a, $b) {
            if($a['order'] === $b['order']) {
                if($a['name'] === $b['name']) {
                    return 0;
                }
                return $a['name'] < $b['name'] ? -1 : 1;
            }
            return $a['order'] < $b['order'] ? -1 : 1;
        });

        return view('admin.modules.index', compact('modules', 'page_title', 'page_description'));
    }

    /**
     * Optimize the modules definition.
     *
     * @return \Illuminate\Http\Response
     */
    public function optimize()
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-optimize'));

        Artisan::call('module:optimize');

        Flash::success(trans('admin/modules/general.status.optimized'));

        return redirect('/admin/modules');
    }

    /**
     * Disables a module.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function disable($slug)
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-disable', ['slug' => $slug]));

        $module = \Module::where('slug', $slug)->first();

        if ($module) {
            if (\Module::isInitialized($slug)) {
                if (\Module::isEnabled($slug)) {
                    \Module::disable($slug);
                    Flash::success(trans('admin/modules/general.status.disabled', ['name' => $module['name']]));
                } else {
                    Flash::warning(trans('admin/modules/general.status.not-enabled', ['name' => $module['name']]));
                }
            } else {
                Flash::warning(trans('admin/modules/general.status.not-initialized', ['name' => $module['name']]));
            }
        } else {
            Flash::error(trans('admin/modules/general.status.not-found', ['slug' => $slug]));
        }

        Flash::success(trans('admin/modules/general.status.disabled'));

        return redirect('/admin/modules');
    }

    /**
     * Enables a module.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function enable($slug)
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-enable', ['slug' => $slug]));

        $module = \Module::where('slug', $slug)->first();

        if ($module) {
            if (\Module::isInitialized($slug)) {
                if (\Module::isDisabled($slug)) {
                    \Module::enable($slug);
                    Flash::success(trans('admin/modules/general.status.enabled', ['name' => $module['name']]));
                } else {
                    Flash::warning(trans('admin/modules/general.status.not-disabled', ['name' => $module['name']]));
                }
            } else {
                Flash::warning(trans('admin/modules/general.status.not-initialized', ['name' => $module['name']]));
            }
        } else {
            Flash::error(trans('admin/modules/general.status.not-found', ['slug' => $slug]));
        }

        return redirect('/admin/modules');
    }


    /**
     * Initialize the modules.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function initialize($slug)
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-initialize', ['slug' => $slug]));

        $module = \Module::where('slug', $slug)->first();

        if ($module) {
            if (\Module::isUninitialized($slug)) {
                \Module::initialize($slug);
                Flash::success(trans('admin/modules/general.status.initialized', ['name' => $module['name']]));
            } else {
                Flash::warning(trans('admin/modules/general.status.already-initialized', ['name' => $module['name']]));
            }
        } else {
            Flash::error(trans('admin/modules/general.status.not-found', ['slug' => $slug]));
        }
        return redirect('/admin/modules');
    }


    public function getModalUninitialize($slug)
    {
        $error = null;

        $module = \Module::where('slug', $slug)->first();

        $modal_title = trans('admin/modules/general.delete-confirm.title');
        $modal_route = route('admin.modules.uninitialize', array('slug' => $slug));
        $modal_body = trans('admin/modules/general.delete-confirm.body', [ 'slug' => $module['slug'], 'name' => $module['name'] ]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));
    }

    /**
     * Uninitialize the modules.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function uninitialize($slug)
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-uninitialize', ['slug' => $slug]));

        $module = \Module::where('slug', $slug)->first();

        if ($module) {
            if (\Module::isInitialized($slug)) {
                if (\Module::isDisabled($slug)) {
                    \Module::uninitialize($slug);
                    Flash::success(trans('admin/modules/general.status.uninitialized', ['name' => $module['name']]));
                } else {
                    Flash::warning(trans('admin/modules/general.status.not-disabled', ['name' => $module['name']]));
                }
            } else {
                Flash::warning(trans('admin/modules/general.status.not-initialized', ['name' => $module['name']]));
            }
        } else {
            Flash::error(trans('admin/modules/general.status.not-found', ['slug' => $slug]));
        }

        return redirect('/admin/modules');
    }

}
