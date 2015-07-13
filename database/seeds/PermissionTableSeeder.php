<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'guest-only',
            'display_name' => 'Guest only access',
            'description' => 'Only guest users can access these.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'name' => 'open-to-all',
            'display_name' => 'Open to all',
            'description' => 'Everyone can access these, even unauthenticated or guest users.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permissions')->insert([
            'name' => 'basic-authenticated',
            'display_name' => 'Basic authenticated',
            'description' => 'Basic permission after being authenticated.',
            'enabled' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    }
}
