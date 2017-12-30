<?php

namespace App\Http\Controllers;


use App\Models\Audit;
use Artisan;
use DataFilter;
use DataGrid;
use Flash;
use Illuminate\Http\Request;
use Module;

class ModulesController extends Controller
{

    static public function GetAuditCategory(Audit $audit)
    {
        return trans('admin/modules/general.audit-log.category');
    }

    static public function GetAuditMessage(Audit $audit)
    {
        $atSymbolPos = strpos($audit->route_action, "@");
        $methodName = substr($audit->route_action, $atSymbolPos);

        switch ($methodName) {
            case "@index":
                $message = trans('admin/modules/general.audit-log.msg-index');
                break;
//            case "@create":
//                $message = trans('admin/permissions/general.audit-log.msg-create');
//                break;
//            case "@store":
//                $message = trans('admin/permissions/general.audit-log.msg-store');
//                break;
//            case "@edit":
//                $message = trans('admin/permissions/general.audit-log.msg-edit');
//                break;
//            case "@update":
//                $message = trans('admin/permissions/general.audit-log.msg-update');
//                break;
//            case "@show":
//                $message = trans('admin/permissions/general.audit-log.msg-show');
//                break;
//            case "@getModalDelete":
//                $message = trans('admin/permissions/general.audit-log.msg-get-modal-delete');
//                break;
//            case "@destroy":
//                $message = trans('admin/permissions/general.audit-log.msg-destroy');
//                break;
//            case "@disable":
//                $message = trans('admin/permissions/general.audit-log.msg-disable');
//                break;
//            case "@enable":
//                $message = trans('admin/permissions/general.audit-log.msg-enable');
//                break;
//            case "@disableSelected":
//                $message = trans('admin/permissions/general.audit-log.msg-disabled-selected');
//                break;
//            case "@enableSelected":
//                $message = trans('admin/permissions/general.audit-log.msg-enabled-selected');
//                break;
            default:
                $message = "Unset action in controller";
                break;
        }
        return $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all()->toArray();
        $grid = DataGrid::source($modules);

        $grid->add('name', 'Name');
        $grid->add('description', 'Description');
        $grid->add('order', 'Order');
        $grid->add('{!! App\Libraries\Utils::modulesActionslinks($slug) !!}', 'Actions');


        $grid->orderBy('name', 'asc');
        $grid->paginate(10);

        $page_title = trans('admin/modules/general.page.index.title');
        $page_description = trans('admin/modules/general.page.index.description');

        return view('admin.modules.index', compact('grid', 'page_title', 'page_description'));
    }


    /**
     * Optimize the modules definition.
     *
     * @return \Illuminate\Http\Response
     */
    public function optimize()
    {
        Artisan::call('module:optimize');

        Flash::success(trans('admin/modules/general.status.optimized'));

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
        $module = \Module::where('slug', $slug);

        if ($module) {
            if (\Module::isUninitialized($slug)) {
                \Module::initialize($slug);
                Flash::success(trans('admin/modules/general.status.initialized', ['name' => $module['name']]));
            } else {
                Flash::warning(trans('admin/modules/general.error.already-initialized', ['name' => $module['name']]));
            }
        } else {
            Flash::error(trans('admin/modules/general.error.not-found', ['slug' => $slug]));
        }
        return redirect('/admin/modules');
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getModalUninitialize($slug)
    {
        $error = null;

        $module = \Module::where('slug', $slug);

        $modal_title = trans('admin/modules/dialog.uninitialize-confirm.title');

        $modal_onclick = '';
        $modal_href = route('admin.modules.uninitialize', array('slug' => $slug));

        $modal_body = trans('admin/modules/dialog.uninitialize-confirm.body', [ 'name' => $module['name'] ]);

        return view('modal_confirmation', compact('error', 'modal_href', 'modal_onclick', 'modal_title', 'modal_body'));
    }

    /**
     * Un-initialize the modules.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function uninitialize($slug)
    {
        $module = \Module::where('slug', $slug);

        if ($module) {
            if (\Module::isInitialized($slug)) {
                if (\Module::isDisabled($slug)) {
                    \Module::uninitialize($slug);
                    Flash::success(trans('admin/modules/general.status.uninitialized', ['name' => $module['name']]));
                } else {
                    Flash::warning(trans('admin/modules/general.error.not-disabled', ['name' => $module['name']]));
                }
            } else {
                Flash::warning(trans('admin/modules/general.error.not-initialized', ['name' => $module['name']]));
            }
        } else {
            Flash::error(trans('admin/modules/general.error.not-found', ['slug' => $slug]));
        }

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
        $module = \Module::where('slug', $slug);

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
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getModalDisable($slug)
    {
        $error = null;

        $module = \Module::where('slug', $slug);

        $modal_title = trans('admin/modules/dialog.disable-confirm.title');

        $modal_onclick = '';
        $modal_href = route('admin.modules.disable', array('slug' => $slug));

        $modal_body = trans('admin/modules/dialog.disable-confirm.body', [ 'name' => $module['name'] ]);

        return view('modal_confirmation', compact('error', 'modal_href', 'modal_onclick', 'modal_title', 'modal_body'));
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
        $module = \Module::where('slug', $slug);

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

        return redirect('/admin/modules');
    }



}