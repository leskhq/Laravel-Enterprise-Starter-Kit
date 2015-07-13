<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /////////
        // Create a few test users.
        $lastNames = [
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
        ];

        foreach($lastNames as $index => $lastName)
        {
            DB::table('users')->insert([
                'username' => 'user' . $index,
                'first_name' => 'User',
                'last_name' => $lastName,
                'email' => 'user' . $index . '@email.com',
                'enabled' => true,
                'password' => bcrypt('Password1'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        /////////
        // Create a few test permissions for the flash-test pages.
        $testLevels = ['success', 'info', 'warning', 'error'];

        foreach($testLevels as $level) {
            DB::table('permissions')->insert([
                'name' => 'test-level-' . $level,
                'display_name' => 'Test level ' . $level,
                'description' => 'Testing level ' . $level,
                'enabled' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        /////////
        // Create a few test permissions for the user/role admin section
        DB::table('permissions')->insert([
            'name' => 'manage-users',
            'display_name' => 'Manage users',
            'description' => 'Allows a user to manage the site users.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'name' => 'manage-roles',
            'display_name' => 'Manage roles',
            'description' => 'Allows a user to manage the site roles.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'name' => 'manage-permissions',
            'display_name' => 'Manage permissions',
            'description' => 'Allows a user to manage the site permissions.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'name' => 'manage-routes',
            'display_name' => 'Manage routes',
            'description' => 'Allows a user to Manage the site routes.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    }
}
