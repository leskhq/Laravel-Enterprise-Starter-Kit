<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;

class DevelopmentSeeder extends Seeder
{

    protected $user;
    protected $permission;


    public function __construct(UserRepository $user, PermissionRepository $permission)
    {
        $this->user = $user;
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
        $this->command->warn('Creating test users');

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
        $user01->attachPermission($permUserCreate);

    }
}
