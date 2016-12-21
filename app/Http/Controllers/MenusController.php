<?php namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Route;
use App\Repositories\AuditRepository as Audit;
use Auth;
use DB;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    /**
     * @param Application $app
     * @param Audit $audit
     */
    public function __construct(Application $app, Audit $audit)
    {
        parent::__construct($app, $audit);
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'menus']);
    }


    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Log action by user.
        Audit::log(Auth::user()->id, trans('admin/menu-builder/menu-builder.audit-log.category'), trans('admin/menu-builder/menu-builder.audit-log.msg-index'));

        // Set page title and description.
        $page_title = trans('admin/menu-builder/menu-builder.page.index.title');
        $page_description = trans('admin/menu-builder/menu-builder.page.index.description');

        // Load all menus ordered by Parent (asc), Position (asc), Label (asc) and finally ID (asc).
        $menus = Menu::orderBy('parent_id', 'ASC')->orderBy('position', 'ASC')->orderBy('label', 'ASC')->orderBy('id', 'ASC')->get();
        // Convert menu query result to JSON for JSTree
        $menusJson = $this->menusOrmToJsTreeJson($menus);

        // List label and id of all menus ordered by Label (asc).
        $parents = Menu::where('separator', '0')->orderBy('label', 'ASC')->orderBy('id', 'ASC')->get()->lists('label', 'id');
        // Convert to array.
        $parents = $parents->toArray();

        // List name and id of all routes ordered by Name (asc).
        $routes = Route::whereNotNull('name')->orderBy('name', 'ASC')->get()->lists('name', 'id');
        // Convert to array.
        $routes = $routes->toArray();
        // Add a blank option at the top.
        $routes = array('blank' => '') + $routes;

        // List display name and id of all permissions ordered by Name (asc).
        $permissions = Permission::orderBy('name', 'ASC')->get()->lists('display_name', 'id');
        // Convert to array.
        $permissions = $permissions->toArray();
        // Add a blank option at the top.
        $permissions = array('blank' => '') + $permissions;

        // Return view
        return view('admin.menus.index', compact('menus', 'menusJson', 'parents', 'routes', 'permissions', 'page_title', 'page_description'));
    }

    /**
     * @param array|Collection $menusCol
     *
     * @return string
     */
    private function menusOrmToJsTreeJson(Collection $menusCol)
    {
        $jsTreeCol = $menusCol->map(function ($item, $key) {
            $id             = $item->id;
            $parent_id      = $item->parent_id;
            $label          = $item->label;
            $icon           = $item->icon;
            // Fix attribute of root item for JSTree
            if ( ($id == $parent_id) && ('Root' == $label) ) {
                $parent_id = '#';
            }

             return collect(['id' => $id, 'parent' => $parent_id, 'text' => $label, 'icon' => $icon]);
        });

        $menusJson = $jsTreeCol->toJson();

        return $menusJson;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $attributes = $request->all();

        $id = $attributes['id'];

        if ($id) { // If $id is not null or blank we must be editing.
            // Locate existing menu item.
            $menuItem = Menu::find($id);

            if (!$menuItem->isEditable()) {
                Flash::warning( trans('admin/menu-builder/menu-builder.update-failed-cant-be-edited', ['id' => $menuItem->id, 'label' => $menuItem->label]) );
            } else {
                // Fix issue #23: using the wrong column name in the unique rule.
                // validate attributes.
                $this->validate($request, array(    'name' => 'required|unique:menus,name,' . $id,
                                                    'label' => 'required',
                ));

                // Log action by user.
                Audit::log(Auth::user()->id, trans('admin/menu-builder/menu-builder.audit-log.category'), trans('admin/menu-builder/menu-builder.audit-log.msg-index'));

                // Update menu item.
                $menuItem->update($attributes);

                Flash::success( trans('admin/menu-builder/menu-builder.update-success') );
            }
        } else { // else creating new menu item.
            // First unset/remove blank 'id' element from the array, otherwise the insert SQL statement will not
            // include an incremented value for the identity column, but instead the value of id which is
            // blank: ''.
            unset($attributes['id']);
            // Validate attributes.
            $this->validate($request, array(    'name' => 'required|unique:menus',
                                                'label' => 'required',
            ));
            // Create new menu item.
            $menuItem = Menu::create($attributes);

            Flash::success( trans('admin/menu-builder/menu-builder.create-success') );
        }

        return redirect('/admin/menus');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu->isDeletable()) {
            Flash::warning( trans('admin/menu-builder/menu-builder.delete-failed-cant-be-deleted', ['id' => $menu->id, 'label' => $menu->label]) );
        } else {
            Audit::log(Auth::user()->id, trans('admin/menu-builder/menu-builder.audit-log.category'), trans('admin/menu-builder/menu-builder.audit-log.msg-destroy', ['label' => $menu->label]));

            $menu->delete($id);

            Flash::success( trans('admin/menu-builder/menu-builder.delete-success') );
        }

        return redirect('/admin/menus');
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     *
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error = null;

        $menu = Menu::find($id);

        if (!$menu->isdeletable()) {
            $modal_title = trans('admin/menu-builder/menu-builder.modal-delete-title-cant-be-deleted');
            $modal_body  = trans('admin/menu-builder/menu-builder.modal-delete-message-cant-be-deleted', ['id' => $menu->id, 'label' => $menu->label]);
            // Force a redirect to the index page if the user clicks on OK.
            $modal_route = route('admin.menus.index');
        } else {
            $modal_title = trans('admin/menu-builder/menu-builder.modal-delete-title');
            $modal_body  = trans('admin/menu-builder/menu-builder.modal-delete-message', ['id' => $menu->id, 'label' => $menu->label]);

            $modal_route = route('admin.menus.delete', array('id' => $menu->id));
        }
        return view('modal_confirmation', compact( 'error', 'modal_route', 'modal_title', 'modal_body' ));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getData(Request $request)
    {
        $id = $request->input('id');
        $menuItem = Menu::with('route')->with('permission')->with('parent')->find($id);

        return $menuItem;
    }

}