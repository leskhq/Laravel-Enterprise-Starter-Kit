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
        $permUserList   = $this->permission->findByField('name', 'core.users.list')->first();
        $permUserShow   = $this->permission->findByField('name', 'core.users.read')->first();
        $permUserCreate = $this->permission->findByField('name', 'core.users.create')->first();
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
            "name"          => "uniquerolename1",
            "display_name"  => "display name 1",
            "description"   => "desc 1",
            "enabled"       => true,
        ]);
        $user01->attachRole($role1);

        $this->command->warn('Creating and assigning unique role 2.');
        $role2 = $this->role->create([
            "name"          => "name 2",
            "display_name"  => "uniqueroledisplayname2",
            "description"   => "desc 2",
            "enabled"       => true,
        ]);
        $user02->attachRole($role2);

        $this->command->warn('Creating and assigning unique role 3.');
        $role3 = $this->role->create([
            "name"          => "name 3",
            "display_name"  => "display name 2",
            "description"   => "uniqueroledesc3",
            "enabled"       => true,
        ]);
        $user03->attachRole($role3);

        $this->command->warn('Creating and assigning unique perm 1.');
        $perm1 = $this->permission->create([
            'name'          => "uniquepermname1",
            'display_name'  => "display name 1",
            'description'   => "desc 1",
            'enabled'       => true,
        ]);
        $user01->attachPermission($perm1);

        $this->command->warn('Creating and assigning unique perm 2.');
        $perm2 = $this->permission->create([
            'name'          => "name 2",
            'display_name'  => "uniquepermdisplayname2",
            'description'   => "desc 2",
            'enabled'       => true,
        ]);
        $user02->attachPermission($perm2);

        $this->command->warn('Creating and assigning unique perm 3.');
        $perm3 = $this->permission->create([
            'name'          => "name 3",
            'display_name'  => "display name 3",
            'description'   => "uniquepermdesc3",
            'enabled'       => true,
        ]);
        $user03->attachPermission($perm3);

    }
}
