<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sroutier\L51ESKModules\Facades\Module;
use App\Repositories\AuditRepository as Audit;
use Auth;
use Laracasts\Flash\Flash;
use Artisan;

class ModulesController extends Controller
{
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

        $modules = Module::sortBy('order')->all();

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
     * @return \Illuminate\Http\Response
     */
    public function disable($slug)
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-disable', ['slug' => $slug]));

        Module::disable($slug);

        Flash::success(trans('admin/modules/general.status.disabled'));

        return redirect('/admin/modules');

    }

    /**
     * Enables a module.
     *
     * @return \Illuminate\Http\Response
     */
    public function enable($slug)
    {
        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-enable', ['slug' => $slug]));

        Module::enable($slug);

        Flash::success(trans('admin/modules/general.status.enabled'));

        return redirect('/admin/modules');

    }


    /**
     * @return \Illuminate\View\View
     */
    public function enableSelected(Request $request)
    {
        $chkMods = $request->input('chkMod');

        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-enabled-selected'), $chkMods);

        if (isset($chkMods))
        {
            foreach ($chkMods as $slug)
            {
                Module::enable($slug);
            }
            Flash::success(trans('admin/modules/general.status.global-enabled'));
        }
        else
        {
            Flash::warning(trans('admin/modules/general.status.no-mod-selected'));
        }
        return redirect('/admin/modules');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function disableSelected(Request $request)
    {
        $chkMods = $request->input('chkMod');

        Audit::log(Auth::user()->id, trans('admin/modules/general.audit-log.category'), trans('admin/modules/general.audit-log.msg-disabled-selected'), $chkMods);

        if (isset($chkMods))
        {
            foreach ($chkMods as $slug)
            {
                Module::disable($slug);
            }
            Flash::success(trans('admin/modules/general.status.global-disabled'));
        }
        else
        {
            Flash::warning(trans('admin/modules/general.status.no-perm-selected'));
        }
        return redirect('/admin/modules');
    }

    /**
     * Initialize the modules.
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
        }
        else {
            Flash::error(trans('admin/modules/general.status.not-found', ['slug' => $slug]));
        }
        return redirect('/admin/modules');

    }

    /**
     * Uninitialize the modules.
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
        }
        else {
            Flash::error(trans('admin/modules/general.status.not-found', ['slug' => $slug]));
        }

        return redirect('/admin/modules');

    }

}
