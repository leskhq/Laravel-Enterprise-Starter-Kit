<?php

use App\Repositories\RoleRepository;
use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;

class DevelopmentSeeder extends Seeder
{

    protected $user;
    protected $role;
    protected $permission;


    public function __construct(UserRepository $user, RoleRepository $role, PermissionRepository $permission)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Running Development seeder.');

        ////////////////////////////////////
        ////////////////////////////////////
        $this->command->warn('Creating core test users.');
        $userList = [
            'user01' => [
                'first_name'    => 'User',
                'last_name'     => 'One',
                'enabled'       => true,
            ],
            'user02' => [
                'first_name'    => 'User',
                'last_name'     => 'Two',
                'enabled'       => false,
            ],
            'user03' => [
                'first_name'    => 'User',
                'last_name'     => 'Three',
                'enabled'       => true,
            ],
        ];
        foreach ($userList as $key => $value)
        {
            $user = $this->user->create([
                "first_name"    => $value['first_name'],
                "last_name"     => $value['last_name'],
                "username"      => $key,
                "email"         => $key."@email.com",
                'password'      => 'Password1',
                "enabled"       => $value['enabled'],
            ]);
            $this->command->info('User created: '. $user->username);
        }
        // Grant user01 permission to list users.
        $user01         = $this->user->findWhere(['username' => 'user01'])->first();
        $permUserList   = $this->permission->findByField('name', 'core.p.users.list')->first();
        $permUserShow   = $this->permission->findByField('name', 'core.p.users.read')->first();
        $permUserCreate = $this->permission->findByField('name', 'core.p.users.create')->first();
        $user01->attachPermission($permUserList);
        $user01->attachPermission($permUserShow);
        $user01->attachPermission($permUserCreate);
        // create 50 users using faker
        $this->command->warn('Creating 50 test users using faker.');
        $users = factory(App\Models\User::class, 50)->create();

        // Build couple unique roles and perms.
        $user01         = $this->user->findWhere(['username' => 'user01'])->first();
        $user02         = $this->user->findWhere(['username' => 'user02'])->first();
        $user03         = $this->user->findWhere(['username' => 'user03'])->first();

        $this->command->warn('Creating and assigning unique role 1.');
        $role1 = $this->role->create([
            "name"          => "myrole01",
            "display_name"  => "My Role  01",
            "description"   => "Desc for my role 01",
            "enabled"       => true,
        ]);

        $this->command->warn('Creating and assigning unique role 2.');
        $role2 = $this->role->create([
            "name"          => "myrole02",
            "display_name"  => "My Role 02",
            "description"   => "Desc for my role 02",
            "enabled"       => true,
        ]);

        $this->command->warn('Creating and assigning unique role 3.');
        $role3 = $this->role->create([
            "name"          => "myrole03",
            "display_name"  => "My Role 03",
            "description"   => "Desc for my role 03",
            "enabled"       => true,
        ]);

        $this->command->warn('Creating and assigning unique perm 1.');
        $perm1 = $this->permission->create([
            'name'          => "myperm01",
            'display_name'  => "My Perm 01",
            'description'   => "Desc for my perm 01",
            'enabled'       => true,
        ]);

        $this->command->warn('Creating and assigning unique perm 2.');
        $perm2 = $this->permission->create([
            'name'          => "myperm02",
            'display_name'  => "My Perm 02",
            'description'   => "Desc for my perm 02",
            'enabled'       => true,
        ]);

        $this->command->warn('Creating and assigning unique perm 3.');
        $perm3 = $this->permission->create([
            'name'          => "myperm03",
            'display_name'  => "My Perm 03",
            'description'   => "Desc for my perm 03",
            'enabled'       => true,
        ]);

        $user01->attachRole($role1);
        $user02->attachRole($role2);
        $user03->attachRole($role3);

        $role1->attachPermission($perm1);
        $role2->attachPermission($perm2);
        $role3->attachPermission($perm3);

        $user01->attachPermission($perm2);
        $user02->attachPermission($perm3);
        $user03->attachPermission($perm1);

    }
}
