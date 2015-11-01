<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Permission;

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
            $testUser = User::create([
                'username'              => 'user' . $index,
                'first_name'            => 'User',
                'last_name'             => $lastName,
                'email'                 => 'user' . $index . '@email.com',
                "password"              => "Password1",
                "auth_type"             => "internal",
                "enabled"               => true
            ]);
        }

        /////////
        // Create a few test permissions for the flash-test pages.
        $testLevels = ['success', 'info', 'warning', 'error'];

        foreach($testLevels as $level) {
            $permGuestOnly = Permission::create([
                'name'          => 'test-level-' . $level,
                'display_name'  => 'Test level ' . $level,
                'description'   => 'Testing level ' . $level,
                'enabled'       => true,
            ]);

        }

    }
}
