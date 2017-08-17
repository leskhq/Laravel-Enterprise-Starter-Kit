<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository as User;

class DevelopmentSeeder extends Seeder
{

    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
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
                'last_name'     => 'One'
            ],
            'user02' => [
                'first_name'    => 'User',
                'last_name'     => 'Two'
            ],
        ];

        foreach ($userList as $key => $value)
        {
            $userRoot = $this->user->create([
                "first_name"    => $value['first_name'],
                "last_name"     => $value['last_name'],
                "username"      => $key,
                "email"         => $key."@email.com",
                'password'      => bcrypt('Password1'),
                "auth_type"     => "internal",
                "enabled"       => true,
            ]);
            $this->command->warn('User created: '. $userRoot->username);
        }


    }
}
