<?php

use Illuminate\Database\Seeder;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\RoleRepository as Role;
use App\Repositories\RouteRepository as Route;
use App\Repositories\UserRepository as User;

class ProductionSeeder extends Seeder
{

    protected $permission;
    protected $role;
    protected $route;
    protected $user;


    public function __construct(Permission $permission, Role $role, Route $route, User $user)
    {
        $this->permission   = $permission;
        $this->role         = $role;
        $this->route        = $route;
        $this->user         = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Running Production seeder.');

        $this->command->info('Truncating security tables.');
        $this->truncateSecurityTables();

        ////////////////////////////////////
        ////////////////////////////////////
        /// Load the routes
        $this->command->info('Loading Laravel routes.');
        $cnt = \App\Models\Route::loadLaravelRoutes('/.*/');
        $this->command->info('Number of Laravel routes loaded: ' . $cnt);

        ////////////////////////////////////
        ////////////////////////////////////
        /// Create basic set of roles
        $this->command->info('Creating permissions and roles.');
        $roleList = [
            'core.admins' => [
                'display_name'  => 'Administrators',
                'description'   => 'Administrators have no restrictions',
            ],
            'core.users' => [
                'display_name'  => 'Users',
                'description'   => 'All authenticated users',
            ],
        ];

        foreach ($roleList as $key => $value)
        {
            $perm = $this->role->create([
                "name"          => $key,
                "display_name"  => $value['display_name'],
                "description"   => $value['description'],
                "enabled"       => true,
            ]);
//            $this->command->info('Permission created: '. $perm->name);
        }

        ////////////////////////////////////
        ////////////////////////////////////
        /// Creating ROOT user.
        $this->command->warn('Creating user root, remember to change the default password.');
        $userRoot = $this->user->create([
            "first_name"    => "Root",
            "last_name"     => "SuperUser",
            "username"      => "root",
            "email"         => "root@email.com",
            'password'      => 'Password1',
            "enabled"       => true,
        ]);

        ////////////////////////////////////
        ////////////////////////////////////
        /// Create basic set of permissions
        $permList = [
            'core.guest-only' => [
                'display_name'  => 'Guest only access',
                'description'   => 'Only guest users can access these.',
            ],
            'core.open-to-all' => [
                'display_name'  => 'Open to all',
                'description'   => 'Everyone can access these, even unauthenticated (guest) users.',
            ],
            'core.basic-authenticated' => [
                'display_name'  => 'Basic authenticated',
                'description'   => 'Basic permission after being authenticated.',
            ],
        ];

        foreach ($permList as $key => $value)
        {
            $perm = $this->permission->create([
                "name"          => $key,
                "display_name"  => $value['display_name'],
                "description"   => $value['description'],
                "enabled"       => true,
            ]);
//            $this->command->info('Permission created: '. $perm->name);
        }


        /**
         * Defines a preset of role and permissions to create or assign.
         *
         * 1) The array below first defines a permission map to use as
         * suffixes when creating permissions. The usual CRUD are
         * defined, but also others can be as required.
         *
         * 2) The second entry in the array defines the roles to create
         * along with the permission(s) to create and assign to the
         * role.
         *
         * The first few roles, and its assigned permission, created below are:
         *
         *      core.permissions.manager
         *          core.permissions.create
         *          core.permissions.read
         *          core.permissions.update
         *          core.permissions.delete
         *
         *      core.permissions.reviewer
         *          core.permissions.read
         *
         */
        $permAndRoles =
            [
                // Defines the permission map to use when creating permissions.
                'permissions_map' => [
                    'ls' => 'list',
                    'c'  => 'create',
                    'r'  => 'read',
                    'u'  => 'update',
                    'd'  => 'delete',
                    'lo' => 'load',
                    'g'  => 'generate',
                    'p'  => 'purge',
                    'en' => 'enable',
                    'di' => 'disable',
                ],
                // Defines the roles to create with their assigned permissions.
                'roles_and_perms' => [
                    // Name of the role
                    'core.permissions.manager' => [
                        // Prefix of the permissions name to assign to the above role.
                        'core.permissions' => [
                            // List of suffixes of the permission looked-up against the permissions_map.
                            'c', 'r', 'u', 'd', 'ls', 'en', 'di',
                        ],
                    ],
                    'core.permissions.reviewer' => [
                        'core.permissions' => [
                            'r', 'ls',
                        ],
                    ],
                    'core.roles.manager' => [
                        'core.roles' => [
                            'c', 'r', 'u', 'd', 'ls', 'en', 'di',
                        ],
                    ],
                    'core.roles.reviewer' => [
                        'core.roles' => [
                            'r', 'ls',
                        ],
                    ],
                    'core.routes.manager' => [
                        'core.routes' => [
                            'c', 'r', 'u', 'd', 'ls', 'en', 'di',
                        ],
                    ],
                    'core.routes.reviewer' => [
                        'core.routes' => [
                            'r', 'ls',
                        ],
                    ],
                    'core.users.manager' => [
                        'core.users' => [
                            'c', 'r', 'u', 'd', 'ls', 'en', 'di',
                        ],
                    ],
                    'core.users.reviewer' => [
                        'core.users' => [
                            'r', 'ls',
                        ],
                    ],
                ],

                // Used to list extra roles that are not yet associated with permissions.
                'roles' => [
                    'core.admins',
                    'core.users',
                ],

            ];

        // Create roles and their permissions.
        foreach ($permAndRoles['roles_and_perms'] as $roleName => $permSet)
        {
            $role = $this->role->firstOrCreate([
                'name'          => $roleName,
                'display_name'  => $roleName,
                'description'   => 'Auto-generated by initial database seeder.',
                'enabled'       => true,
            ]);
//            $this->command->info('Role created: '. $role->name);

            foreach ($permSet as $prefix => $permTokens)
            {
                foreach ($permTokens as $permToken)
                {
                    $perm = $this->permission->firstOrCreate([
                        'name'          => $prefix . '.' . $permAndRoles['permissions_map'][$permToken],
                        'display_name'  => $prefix . '.' . $permAndRoles['permissions_map'][$permToken],
                        'description'   => 'Auto-generated by initial database seeder.',
                        'enabled'       => true,
                    ]);
//                    $this->command->info('Permission created or located: '. $perm->name);
                    $role->attachPermission($perm);
//                    $this->command->info('Assigned permission ['.$perm->name.'] to role ['.$role->name.'].');
                }
            }
        }


        ////////////////////////////////////
        ////////////////////////////////////
        /// Locate some permissions to assign them.
        $permGuestOnly          = $this->permission->findByField('name', 'core.guest-only')->first();
        $permOpenToAll          = $this->permission->findByField('name', 'core.open-to-all')->first();
        $permBasicAuthenticated = $this->permission->findByField('name', 'core.basic-authenticated')->first();
        $permPermissionCreate   = $this->permission->findByField('name', 'core.permissions.create')->first();
        $permPermissionRead     = $this->permission->findByField('name', 'core.permissions.read')->first();
        $permPermissionUpdate   = $this->permission->findByField('name', 'core.permissions.update')->first();
        $permPermissionDelete   = $this->permission->findByField('name', 'core.permissions.delete')->first();
        $permPermissionList     = $this->permission->findByField('name', 'core.permissions.list')->first();
        $permRoleCreate         = $this->permission->findByField('name', 'core.roles.create')->first();
        $permRoleRead           = $this->permission->findByField('name', 'core.roles.read')->first();
        $permRoleUpdate         = $this->permission->findByField('name', 'core.roles.update')->first();
        $permRoleDelete         = $this->permission->findByField('name', 'core.roles.delete')->first();
        $permRoleList           = $this->permission->findByField('name', 'core.roles.list')->first();
        $permRouteCreate         = $this->permission->findByField('name', 'core.routes.create')->first();
        $permRouteRead           = $this->permission->findByField('name', 'core.routes.read')->first();
        $permRouteUpdate         = $this->permission->findByField('name', 'core.routes.update')->first();
        $permRouteDelete         = $this->permission->findByField('name', 'core.routes.delete')->first();
        $permRouteList           = $this->permission->findByField('name', 'core.routes.list')->first();
        $permUserCreate         = $this->permission->findByField('name', 'core.users.create')->first();
        $permUserRead           = $this->permission->findByField('name', 'core.users.read')->first();
        $permUserUpdate         = $this->permission->findByField('name', 'core.users.update')->first();
        $permUserDelete         = $this->permission->findByField('name', 'core.users.delete')->first();
        $permUserList           = $this->permission->findByField('name', 'core.users.list')->first();

        ////////////////////////////////////
        ////////////////////////////////////
        /// Locate some roles to assign them.
        $roleAdmins     = $this->role->findByField('name', 'core.admins')->first();
        $roleUsers      = $this->role->findByField('name', 'core.users')->first();

        ////////////////////////////////////
        ////////////////////////////////////
        /// Associate permissions to roles.
        $roleUsers->attachPermission($permBasicAuthenticated);

        ////////////////////////////////////
        ////////////////////////////////////
        /// Associating permissions to routes.
        $this->command->info('Associating permissions to routes.');
        /// Open to all
        $authRoutes = $this->route->findWhere([['action_name', 'like', 'App\\\\Http\\\\Controllers\\\\Auth\\\\%']]);
        foreach ($authRoutes as $route)
        {
            $route->permission()->associate($permOpenToAll)
                ->save();
        }
        $this->route->findByField('name', 'backslash')->first()
            ->permission()->associate($permOpenToAll)
            ->save();
        $this->route->findByField('name', 'home')->first()
            ->permission()->associate($permOpenToAll)
            ->save();
        $this->route->findByField('name', 'index')->first()
            ->permission()->associate($permOpenToAll)
            ->save();
        $this->route->findByField('name', 'welcome')->first()
            ->permission()->associate($permOpenToAll)
            ->save();
        $this->route->findByField('name', 'faust')->first()
            ->permission()->associate($permOpenToAll)
            ->save();
        /// Basic authenticated
        $this->route->findByField('name', 'dashboard')->first()
            ->permission()->associate($permBasicAuthenticated)
            ->save();
        /// Permissions
        $this->route->findByField('name', 'admin.permissions.index')->first()
            ->permission()->associate($permPermissionList)
            ->save();
        $this->route->findByField('name', 'admin.permissions.create')->first()
            ->permission()->associate($permPermissionCreate)
            ->save();
        $this->route->findByField('name', 'admin.permissions.store')->first()
            ->permission()->associate($permPermissionCreate)
            ->save();
        $this->route->findByField('name', 'admin.permissions.show')->first()
            ->permission()->associate($permPermissionRead)
            ->save();
        $this->route->findByField('name', 'admin.permissions.edit')->first()
            ->permission()->associate($permPermissionUpdate)
            ->save();
        $this->route->findByField('name', 'admin.permissions.update')->first()
            ->permission()->associate($permPermissionUpdate)
            ->save();
        $this->route->findByField('name', 'admin.permissions.destroy')->first()
            ->permission()->associate($permPermissionDelete)
            ->save();
        /// Roles
        $this->route->findByField('name', 'admin.roles.index')->first()
            ->permission()->associate($permRoleList)
            ->save();
        $this->route->findByField('name', 'admin.roles.create')->first()
            ->permission()->associate($permRoleCreate)
            ->save();
        $this->route->findByField('name', 'admin.roles.store')->first()
            ->permission()->associate($permRoleCreate)
            ->save();
        $this->route->findByField('name', 'admin.roles.show')->first()
            ->permission()->associate($permRoleRead)
            ->save();
        $this->route->findByField('name', 'admin.roles.edit')->first()
            ->permission()->associate($permRoleUpdate)
            ->save();
        $this->route->findByField('name', 'admin.roles.update')->first()
            ->permission()->associate($permRoleUpdate)
            ->save();
        $this->route->findByField('name', 'admin.roles.destroy')->first()
            ->permission()->associate($permRoleDelete)
            ->save();
        /// Routes
        $this->route->findByField('name', 'admin.routes.index')->first()
            ->permission()->associate($permRouteList)
            ->save();
        $this->route->findByField('name', 'admin.routes.create')->first()
            ->permission()->associate($permRouteCreate)
            ->save();
        $this->route->findByField('name', 'admin.routes.store')->first()
            ->permission()->associate($permRouteCreate)
            ->save();
        $this->route->findByField('name', 'admin.routes.show')->first()
            ->permission()->associate($permRouteRead)
            ->save();
        $this->route->findByField('name', 'admin.routes.edit')->first()
            ->permission()->associate($permRouteUpdate)
            ->save();
        $this->route->findByField('name', 'admin.routes.update')->first()
            ->permission()->associate($permRouteUpdate)
            ->save();
        $this->route->findByField('name', 'admin.routes.destroy')->first()
            ->permission()->associate($permRouteDelete)
            ->save();
        /// Users
        $this->route->findByField('name', 'admin.users.index')->first()
            ->permission()->associate($permUserList)
            ->save();
        $this->route->findByField('name', 'admin.users.create')->first()
            ->permission()->associate($permUserCreate)
            ->save();
        $this->route->findByField('name', 'admin.users.store')->first()
            ->permission()->associate($permUserCreate)
            ->save();
        $this->route->findByField('name', 'admin.users.show')->first()
            ->permission()->associate($permUserRead)
            ->save();
        $this->route->findByField('name', 'admin.users.edit')->first()
            ->permission()->associate($permUserUpdate)
            ->save();
        $this->route->findByField('name', 'admin.users.update')->first()
            ->permission()->associate($permUserUpdate)
            ->save();
        $this->route->findByField('name', 'admin.users.destroy')->first()
            ->permission()->associate($permUserDelete)
            ->save();

    }

    /**
     * Truncates all the security tables and the users table
     * @return    void
     */
    public function truncateSecurityTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Permission::truncate();
        \App\Models\Route::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
