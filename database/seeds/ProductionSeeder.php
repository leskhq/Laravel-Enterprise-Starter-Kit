<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository as User;

class ProductionSeeder extends Seeder
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
        $this->command->info('Running Production seeder.');

        $this->command->info('Truncating security tables');
        $this->truncateSecurityTables();

        ////////////////////////////////////
        ////////////////////////////////////
        $this->command->warn('Creating user root, remember to change the default password.');
        $userRoot = $this->user->create([
            "first_name"    => "Root",
            "last_name"     => "SuperUser",
            "username"      => "root",
            "email"         => "root@email.com",
            'password'      => bcrypt('Password1'),
            "auth_type"     => "internal",
            "enabled"       => true,
        ]);


    }

    /**
     * Truncates all the security tables and the users table
     * @return    void
     */
    public function truncateSecurityTables()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
//        DB::table('permission_role')->truncate();
//        DB::table('permission_user')->truncate();
//        DB::table('role_user')->truncate();
//        \App\Models\User::truncate();
//        \App\Models\Role::truncate();
//        \App\Models\Permission::truncate();
//        \App\Models\Route::truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
