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
            'name'         => 'manage-expeditions',
            'display_name' => 'Manage expeditions',
            'description'  => 'Allows a user to manage the site expeditions.',
            'enabled'      => true,
        ]);
        $permManageProducts = Permission::create([
            'name'         => 'manage-products',
            'display_name' => 'Manage products',
            'description'  => 'Allows a user to manage the site products.',
            'enabled'      => true,
        ]);
        $permManageSuppliers = Permission::create([
            'name'         => 'manage-suppliers',
            'display_name' => 'Manage suppliers',
            'description'  => 'Allows a user to manage the site suppliers.',
            'enabled'      => true,
        ]);
        $permManageCustomers = Permission::create([
            'name'         => 'manage-customers',
            'display_name' => 'Manage customers',
            'description'  => 'Allows a user to manage the site customers and the simmilar features.',
            'enabled'      => true,
        ]);
        $permManageSales = Permission::create([
            'name'         => 'manage-sales',
            'display_name' => 'Manage sales',
            'description'  => 'Allows a user to manage the site sales and the simmilar features.',
            'enabled'      => true,
        ]);

        ////////////////////////////////////
        // Associate permission to routes
        $routeExpeditionIndex = Route::where('name', 'admin.expeditions.index')->first();
        // get all the expedition routes
        $routeExpeditions     = Route::where('name', 'like', 'admin.expeditions.'.'%')->get();
        // assign the manage expeditions perms to each expedition routes
        foreach ($routeExpeditions as $key => $value) {
            $value->permission()->associate($permManageExpeditions);
            $value->save();
        }

        $routeProductIndex = Route::where('name', 'admin.products.index')->first();
        // get all the product routes
        $routeProducts     = Route::where('name', 'like', 'admin.products.'.'%')->get();
        // assign the manage products perms to each product routes
        foreach ($routeProducts as $key => $value) {
            $value->permission()->associate($permManageProducts);
            $value->save();
        }

        $routeSupplierIndex = Route::where('name', 'admin.suppliers.index')->first();
        // get all the Supplier routes
        $routeSuppliers     = Route::where('name', 'like', 'admin.suppliers.'.'%')->get();
        // assign the manage suppliers perms to each supplier routes
        foreach ($routeSuppliers as $key => $value) {
            $value->permission()->associate($permManageSuppliers);
            $value->save();
        }

        // get all the Customer routes
        $routeCustomers = Route::where('name', 'like', 'admin.customers.'.'%')->get();
        // assign the manage customers perms to each customer routes
        foreach ($routeCustomers as $key => $value) {
            $value->permission()->associate($permManageCustomers);
            $value->save();
        }

        $routeCustomerCandidateIndex  = Route::where('name', 'admin.customer-candidates.index')->first();
        $routeCustomerCandidateCreate = Route::where('name', 'admin.customer-candidates.create')->first();
        // get all the customer candidate routes
        $routeCustomerCandidates = Route::where('name', 'like', 'admin.customer-candidates.'.'%')->get();
        // assign the manage customers perms to each customer candidate routes
        foreach ($routeCustomerCandidates as $key => $value) {
            $value->permission()->associate($permManageCustomers);
            $value->save();
        }

        $routeCustomerFollowupIndex = Route::where('name', 'admin.customer-followups.index')->first();
        // get all the customer followup routes
        $routeCustomerFollowups = Route::where('name', 'like', 'admin.customer-followups.'.'%')->get();
        // assign the manage customers perms to each customer followup routes
        foreach ($routeCustomerFollowups as $key => $value) {
            $value->permission()->associate($permManageCustomers);
            $value->save();
        }

        $routeCandidateFollowupIndex = Route::where('name', 'admin.candidate-followups.index')->first();
        // get all the customer candidate followup routes
        $routeCandidateFollowups = Route::where('name', 'like', 'admin.candidate-followups.'.'%')->get();
        // assign the manage candidate followup perms to each customer candidate followup routes
        foreach ($routeCandidateFollowups as $key => $value) {
            $value->permission()->associate($permManageCustomers);
            $value->save();
        }

        $routeSalesCreate = Route::where('name', 'admin.sales.create')->first();
        $routeSalesIndex  = Route::where('name', 'admin.sales.index')->first();
        $routeSalesReport = Route::where('name', 'admin.sales.report')->first();
        // get all the sale routes
        $routeSales = Route::where('name', 'like', 'admin.sales.'.'%')->get();
        // assign the manage sale perms to each sale routes
        foreach ($routeSales as $key => $value) {
            $value->permission()->associate($permManageSales);
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
            'parent_id'     => $menuHome->id,                  // Parent is home
            'route_id'      => $routeExpeditionIndex->id,      // Route to expedition index
            'permission_id' => null,                           // Get permission from route
        ]);
        $menuProducts = Menu::create([
            'name'          => 'products',
            'label'         => 'Products',
            'position'      => 1,
            'icon'          => 'fa fa-edit text-green',
            'separator'     => false,
            'url'           => '/admin/products/1/cat',  // custom url
            'enabled'       => true,
            'parent_id'     => $menuHome->id,            // Parent is home
            'route_id'      => null,
            'permission_id' => $permManageProducts->id,  // add the perm since we are not assign any route
        ]);
        $menuSuppliers = Menu::create([
            'name'          => 'suppliers',
            'label'         => 'Suppliers',
            'position'      => 1,
            'icon'          => 'fa fa-cubes text-light-blue',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuHome->id,               // Parent is home
            'route_id'      => $routeSupplierIndex->id,     // Route to supplier index
            'permission_id' => null,                        // Get permission from route.
        ]);

        // create the customers menu parent_id
        $menuCustomersParent = Menu::create([
            'name'          => 'customers',
            'label'         => 'Customers',
            'position'      => 1,
            'icon'          => 'fa fa-male text-aqua',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuHome->id,               // Parent is home
            'route_id'      => null,                        // null because it's a parent menu
            'permission_id' => null,                        // null because it's a parent menu
        ]);
        $menuCreateCustomer = Menu::create([
            'name'          => 'create-customer',
            'label'         => 'Create Customer / Candidate',
            'position'      => 0,
            'icon'          => 'fa fa-plus text-aqua',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => $routeCustomerCandidateCreate->id,   // Route to customer candidate create
            'permission_id' => null,                                // Get permission from route
        ]);

        // start create the customer menus by type
        $menuCustomerOne = Menu::create([
            'name'          => 'customer-type-one',
            'label'         => 'Licensed BO Partners',
            'position'      => 1,
            'icon'          => 'fa fa-circle-o text-red',
            'separator'     => false,
            'url'           => '/admin/customers/1/type',
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => null,                                // null
            'permission_id' => $permManageCustomers->id,            // assign the manage customers perm
        ]);
        $menuCustomerTwo = Menu::create([
            'name'          => 'customer-type-two',
            'label'         => 'Official Agents',
            'position'      => 2,
            'icon'          => 'fa fa-circle-o text-yellow',
            'separator'     => false,
            'url'           => '/admin/customers/2/type',
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => null,                                // null
            'permission_id' => $permManageCustomers->id,            // assign the manage customers perm
        ]);
        $menuCustomerThree = Menu::create([
            'name'          => 'customer-type-three',
            'label'         => 'Free Agents',
            'position'      => 2,
            'icon'          => 'fa fa-circle-o text-yellow',
            'separator'     => false,
            'url'           => '/admin/customers/3/type',
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => null,                                // null
            'permission_id' => $permManageCustomers->id,            // assign the manage customers perm
        ]);
        $menuCustomerFour = Menu::create([
            'name'          => 'customer-type-four',
            'label'         => 'Regular Customers',
            'position'      => 3,
            'icon'          => 'fa fa-circle-o text-green',
            'separator'     => false,
            'url'           => '/admin/customers/4/type',
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => null,                                // null
            'permission_id' => $permManageCustomers->id,            // assign the manage customers perm
        ]);
        $menuCustomerSix = Menu::create([
            'name'          => 'customer-type-six',
            'label'         => 'Genuine BO Partners',
            'position'      => 1,
            'icon'          => 'fa fa-circle-o text-red',
            'separator'     => false,
            'url'           => '/admin/customers/6/type',
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => null,                                // null
            'permission_id' => $permManageCustomers->id,            // assign the manage customers perm
        ]);
        // end customer menus by type

        $menuCustomerCandidates = Menu::create([
            'name'          => 'customer-candidates',
            'label'         => 'Customer Candidates',
            'position'      => 9,
            'icon'          => 'fa fa-user text-green',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => $routeCustomerCandidateIndex->id,    // Route to customer candidate index
            'permission_id' => null,                                // Get permission from route
        ]);
        $menuCustomerFollowups = Menu::create([
            'name'          => 'customer-followups',
            'label'         => 'Customer Followups',
            'position'      => 9,
            'icon'          => 'fa fa-hand-peace-o',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => $routeCustomerFollowupIndex->id,     // Route to customer followup index
            'permission_id' => null,                                // Get permission from route
        ]);
        $menuCandidateFollowups = Menu::create([
            'name'          => 'candidate-followups',
            'label'         => 'Customer Candidate Followups',
            'position'      => 10,
            'icon'          => 'fa fa-hand-peace-o',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuCustomersParent->id,            // Parent is customers
            'route_id'      => $routeCandidateFollowupIndex->id,    // Route to customer candidate followup index
            'permission_id' => null,                                // Get permission from route
        ]);

        $menuSalesParent = Menu::create([
            'name'          => 'sales-parent',
            'label'         => 'Sales',
            'position'      => 1,
            'icon'          => 'fa fa-money text-purple',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuHome->id,                   // Parent itself
            'route_id'      => null,                            // null, since it's a parent menu
            'permission_id' => null,
        ]);

        $menuSalesCreate = Menu::create([
            'name'          => 'create-sale',
            'label'         => 'Create New Sale',
            'position'      => 0,
            'icon'          => 'fa fa-plus text-light-green',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuSalesParent->id,        // Parent sales
            'route_id'      => $routeSalesCreate->id,       // Route to sales create
            'permission_id' => null,
        ]);

        $menuSalesIndex = Menu::create([
            'name'          => 'sales',
            'label'         => 'Sales Index',
            'position'      => 1,
            'icon'          => 'fa fa-bars text-aqua',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuSalesParent->id,        // Parent sales
            'route_id'      => $routeSalesIndex->id,       // Route to sales index
            'permission_id' => null,
        ]);

        $menuSalesReport = Menu::create([
            'name'          => 'sales-report',
            'label'         => 'Sales Report',
            'position'      => 1,
            'icon'          => 'fa fa-line-chart text-red',
            'separator'     => false,
            'url'           => null,
            'enabled'       => true,
            'parent_id'     => $menuSalesParent->id,        // Parent sales
            'route_id'      => $routeSalesReport->id,       // Route to sales report
            'permission_id' => null,
        ]);
    }
}
