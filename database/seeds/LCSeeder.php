<?php

use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Menu;
use App\Models\Route;
use App\Models\Role;

class LCSeeder extends Seeder
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
        $permBasicAdminAuthenticated = Permission::create([
            'name'         => 'basic-admin-authenticated',
            'display_name' => 'Basic Admin Authenticated',
            'description'  => 'Allows a user to view the site index of each features.',
            'enabled'      => true,
        ]);

        // TODO: create manage employee permission
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
        $permManageFollowups = Permission::create([
            'name'         => 'manage-followups',
            'display_name' => 'Manage Followups',
            'description'  => 'Allows a user to manage the site followups and the simmilar features.',
            'enabled'      => true,
        ]);
        $permManageSales = Permission::create([
            'name'         => 'manage-sales',
            'display_name' => 'Manage sales',
            'description'  => 'Allows a user to manage the site sales and the simmilar features.',
            'enabled'      => true,
        ]);

        $permUpdateStatus = Permission::create([
            'name'         => 'update sale status',
            'display_name' => 'Update Sale Status',
            'description'  => 'Allows a user to update the sale status.',
            'enabled'      => true,
        ]);

        ////////////////////////////////////
        // Associate permission to routes
        ////////////////////////////////////
        //  expedition routes
        $routeExpeditionIndex = Route::where('name', 'admin.expeditions.index')->first();
        $routeExpeditionIndex->permission()->associate($permBasicAdminAuthenticated);
        $routeExpeditionIndex->save();
        // get all the expedition routes
        $routeExpeditions     = Route::where('name', 'like', 'admin.expeditions.'.'%')->get();
        // assign the manage expeditions perms to each expedition routes
        foreach ($routeExpeditions as $key => $value) {
            if ($value->name != 'admin.expeditions.index') {
                $value->permission()->associate($permManageExpeditions);
                $value->save();
            }
        }
        //  product routes
        $routeProductIndex = Route::where('name', 'admin.products.index')->first();
        $routeProductIndex->permission()->associate($permBasicAdminAuthenticated);
        $routeProductIndex->save();
        // get all the product routes
        $routeProducts     = Route::where('name', 'like', 'admin.products.'.'%')->get();
        // assign the manage products perms to each product routes
        foreach ($routeProducts as $key => $value) {
            if ($value->name != 'admin.products.index') {
                $value->permission()->associate($permManageProducts);
                $value->save();
            }
        }
        //  supplier routes
        $routeSupplierIndex = Route::where('name', 'admin.suppliers.index')->first();
        $routeSupplierIndex->permission()->associate($permBasicAdminAuthenticated);
        $routeSupplierIndex->save();
        // get all the Supplier routes
        $routeSuppliers     = Route::where('name', 'like', 'admin.suppliers.'.'%')->get();
        // assign the manage suppliers perms to each supplier routes
        foreach ($routeSuppliers as $key => $value) {
            if ($value->name != 'admin.suppliers.index') {
                $value->permission()->associate($permManageSuppliers);
                $value->save();
            }
        }
        //  customer routes
        $routeCustomerIndex = Route::where('name', 'admin.customers.index')->first();
        $routeCustomerIndex->permission()->associate($permBasicAdminAuthenticated);
        $routeCustomerIndex->save();
        // get all the Customer routes
        $routeCustomers = Route::where('name', 'like', 'admin.customers.'.'%')->get();
        // assign the manage customers perms to each customer routes
        foreach ($routeCustomers as $key => $value) {
            if ($value->name != 'admin.customers.index') {
                $value->permission()->associate($permManageCustomers);
                $value->save();
            }
        }
        //  customer candidate routes
        $routeCustomerCandidateIndex  = Route::where('name', 'admin.customer-candidates.index')->first();
        $routeCustomerCandidateIndex->permission()->associate($permBasicAdminAuthenticated);
        $routeCustomerCandidateIndex->save();
        // get all the customer candidate routes
        $routeCustomerCandidates = Route::where('name', 'like', 'admin.customer-candidates.'.'%')->get();
        // assign the manage customers perms to each customer candidate routes
        foreach ($routeCustomerCandidates as $key => $value) {
            if ($value->name != 'admin.customer-candidates.index') {
                $value->permission()->associate($permManageCustomers);
                $value->save();
            }
        }
        //  customer followup routes
        // get all the customer followup routes
        $routeCustomerFollowups = Route::where('name', 'like', 'admin.customer-followups.'.'%')->get();
        // assign the manage customers perms to each customer followup routes
        foreach ($routeCustomerFollowups as $key => $value) {
            $value->permission()->associate($permManageFollowups);
            $value->save();
        }
        //  customer candidate followup routes
        // get all the customer candidate followup routes
        $routeCandidateFollowups = Route::where('name', 'like', 'admin.candidate-followups.'.'%')->get();
        // assign the manage candidate followup perms to each customer candidate followup routes
        foreach ($routeCandidateFollowups as $key => $value) {
            $value->permission()->associate($permManageFollowups);
            $value->save();
        }
        //  sale routes
        $routeSaleUpdateStatus = Route::where('name', 'admin.sales.update-status')->first();
        $routeSaleUpdateStatus->permission()->associate($permUpdateStatus);
        $routeSaleUpdateStatus->save();
        // get all the sale routes
        $routeSales = Route::where('name', 'like', 'admin.sales.'.'%')->get();
        // assign the manage sale perms to each sale routes
        foreach ($routeSales as $key => $value) {
            if ($value->name != 'admin.sales.update-status') {
                $value->permission()->associate($permManageSales);
                $value->save();
            }
        }

        ////////////////////////////////////
        // Create laundry cleanique set roles
        $roleSecretaries = Role::create([
            "name"          => "secretaries",
            "display_name"  => "Secretaries",
            "description"   => "Secretaries are granted all permissions to the Admin|Sales section",
            "enabled"       => true
            ]);
        $roleSecretaries->perms()->attach($permBasicAdminAuthenticated->id);
        $roleSecretaries->perms()->attach($permManageSales->id);
        $roleSecretaries->perms()->attach($permUpdateStatus->id);

        $roleMarketings = Role::create([
            "name"          => "marketings",
            "display_name"  => "Marketings",
            "description"   => "Marketings are granted all permissions to the Admin|Customers, Followup section",
            "enabled"       => true
            ]);
        $roleMarketings->perms()->attach($permBasicAdminAuthenticated->id);
        $roleMarketings->perms()->attach($permManageCustomers->id);
        $roleMarketings->perms()->attach($permManageFollowups->id);

        $rolePurcashings = Role::create([
            "name"          => "purcashings",
            "display_name"  => "Purcashings",
            "description"   => "Purcashings are granted all permissions to the Admin|Suppliers, Expeditions section",
            "enabled"       => true
            ]);
        $rolePurcashings->perms()->attach($permBasicAdminAuthenticated->id);
        $rolePurcashings->perms()->attach($permManageSuppliers->id);
        $rolePurcashings->perms()->attach($permManageExpeditions->id);

        $roleProductions = Role::create([
            "name"          => "productions",
            "display_name"  => "Productions",
            "description"   => "Productions are granted all permissions to the Admin|Products and some Sales section",
            "enabled"       => true
            ]);
        $roleProductions->perms()->attach($permBasicAdminAuthenticated->id);
        $roleProductions->perms()->attach($permManageProducts->id);
        $roleProductions->perms()->attach($permUpdateStatus->id);

        $roleOperationals = Role::create([
            "name"          => "operationals",
            "display_name"  => "Operationals",
            "description"   => "Operationals are granted all permissions to the Admin|Customers, Outlets section",
            "enabled"       => true
            ]);
        $roleOperationals->perms()->attach($permManageCustomers->id);
        // TODO : add permission to manage the outlets section

        $roleHrga = Role::create([
            "name"          => "hrga",
            "display_name"  => "HRGA",
            "description"   => "HRGA are granted all permissions to the Admin|Employes section",
            "enabled"       => true
            ]);
        $roleHrga->perms()->attach($permBasicAdminAuthenticated->id);
        // TODO : add permission to manage the empoloyes section

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
            'route_id'      => Route::where('name', 'admin.customer-candidates.create')->first()->id,   // Route to customer candidate create
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
            'route_id'      => Route::where('name', 'admin.customer-followups.index')->first()->id,     // Route to customer followup index
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
            'route_id'      => Route::where('name', 'admin.candidate-followups.index')->first()->id,    // Route to customer candidate followup index
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
            'route_id'      => Route::where('name', 'admin.sales.create')->first()->id,       // Route to sales create
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
            'route_id'      => Route::where('name', 'admin.sales.index')->first()->id,       // Route to sales index
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
            'route_id'      => Route::where('name', 'admin.sales.report')->first()->id,       // Route to sales report
            'permission_id' => null,
        ]);
    }
}
