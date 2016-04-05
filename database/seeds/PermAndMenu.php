<?php

use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Menu;
use App\Models\Route;

class PermAndMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ////////////////////////////////////
        //
        // IMPORTANT: Make sure to do load all routes from routes index page
        //
        ////////////////////////////////////

        ////////////////////////////////////
        // Create custom set of permissions
        $permManageExpeditions = Permission::create([
            'name'         => 'manage-permissions',
            'display_name' => 'Manage Permissions',
            'description'  => 'Allows a user to manage the site permissions.',
            'enabled'      => true,
        ]);
        $permManageProducts = Permission::create([
            'name'         => 'manage-products',
            'display_name' => 'Manage Products',
            'description'  => 'Allows a user to manage the site products.',
            'enabled'      => true,
        ]);
        $permManageSuppliers = Permission::create([
            'name'         => 'manage-suppliers',
            'display_name' => 'Manage Suppliers',
            'description'  => 'Allows a user to manage the site suppliers.',
            'enabled'      => true,
        ]);

        ////////////////////////////////////
        // Associate permission to routes
        $routeExpeditionIndex = Route::where('name', 'admin.expeditions.index')->first();
        // get all the expedition routes
        $routeExpeditionIndexs = Route::where('name', 'like', 'admin.expeditions.'.'%')->get();
        // give the manage expeditions perms to each routes
        foreach ($routeExpeditionIndexs as $key => $value) {
            $value->permission()->associate($permManageExpeditions);
            $value->save();
        }

        $routeProductIndex = Route::where('name', 'admin.products.index')->first();
        // get all the product routes
        $routeProductIndexs = Route::where('name', 'like', 'admin.products.'.'%')->get();
        // give the manage products perms to each routes
        foreach ($routeProductIndexs as $key => $value) {
            $value->permission()->associate($permManageProducts);
            $value->save();
        }

        $routeSupplierIndex = Route::where('name', 'admin.suppliers.index')->first();
        // get all the Supplier routes
        $routeSupplierIndexs = Route::where('name', 'like', 'admin.suppliers.'.'%')->get();
        // give the manage suppliers perms to each routes
        foreach ($routeSupplierIndexs as $key => $value) {
            $value->permission()->associate($permManageSuppliers);
            $value->save();
        }

        ////////////////////////////////////
        // Get the parent menu
        $menuHome = Menu::where('name', 'home')->first();

        // Create menus
        $menuExpeditions = Menu::create([
            'name'          => 'expeditions',
            'label'         => 'Expeditions',
            'position'      => 1,
            'icon'          => 'fa fa-truck text-maroon',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is home.
            'route_id'      => $routeExpeditionIndex->id,      // Route to expedition index
            'permission_id' => null,                // Get permission from route.
        ]);
        $menuProducts = Menu::create([
            'name'          => 'products',
            'label'         => 'Products',
            'position'      => 1,
            'icon'          => 'fa fa-edit text-green',
            'separator'     => false,
            'url'           => '/admin/products/cat/1',     // custom url
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is home.
            'route_id'      => null,
            'permission_id' => $permManageProducts->id,                // add the perm since we are not using the route
        ]);
        $menuSuppliers = Menu::create([
            'name'          => 'suppliers',
            'label'         => 'Suppliers',
            'position'      => 1,
            'icon'          => 'fa fa-cubes text-light-blue',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuHome->id,       // Parent is home.
            'route_id'      => $routeSupplierIndex->id,      // Route to supplier index
            'permission_id' => null,                // Get permission from route.
        ]);
    }
}
