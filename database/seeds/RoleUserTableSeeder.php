<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User root is a member of admins.
        DB::table('role_user')->insert([
            'user_id' => 1,  // root
            'role_id' => 1,  // admins
        ]);

        // User root is a member is users.
        DB::table('role_user')->insert([
            'user_id' => 1,  // root
            'role_id' => 2,  // users
        ]);

    }
}
