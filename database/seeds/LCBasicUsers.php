<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class LCBasicUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get all the needed roles to assigning the users
        $roleAdmins = Role::where('name', 'admins')->first();
        $rolePurcashings = Role::where('name', 'purcashings')->first();
        $roleSecretaries = Role::where('name', 'secretaries')->first();
        $roleMarketings = Role::where('name', 'marketings')->first();
        $roleProductions = Role::where('name', 'productions')->first();

        ////////////////////////////////////
        // Create laundry cleanique set users
        // Create user: yudi ( Directur President )
        // Assign membership to role admins, membership to role users is
        // automatic.
        $userYudi = User::create([
            "first_name"    => "Yudi",
            "last_name"     => "Saputra",
            "username"      => "yudi",
            "email"         => "yudi.ceo@indotechgroup.co.id",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userYudi->roles()->attach($roleAdmins->id);

        $userIchan = User::create([
            "first_name"    => "Ichan",
            "last_name"     => "Financial Directur",
            "username"      => "ichan",
            "email"         => "ichan@indotechgroup.co.id",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userIchan->roles()->attach($roleAdmins->id);

        $userMirna = User::create([
            "first_name"    => "Mirna",
            "last_name"     => "Financial Accounting Manager",
            "username"      => "mirna",
            "email"         => "nina@indotechgroup.co.id",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userMirna->roles()->attach($roleAdmins->id);

        $userManager = User::create([
            "first_name"    => "General",
            "last_name"     => "Manager",
            "username"      => "manager",
            "email"         => "manager@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userManager->roles()->attach($roleAdmins->id);

        $userAssistant = User::create([
            "first_name"    => "Personal",
            "last_name"     => "Assistant Directur",
            "username"      => "assistant_directur",
            "email"         => "assistant_directur@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userAssistant->roles()->attach($roleAdmins->id);

        $userPurcashing = User::create([
            "first_name"    => "HOD",
            "last_name"     => "Purcashing",
            "username"      => "purcashing",
            "email"         => "purcashing@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userPurcashing->roles()->attach($rolePurcashings->id);

        $userMarketings = User::create([
            "first_name"    => "HOD",
            "last_name"     => "Marketing",
            "username"      => "marketing",
            "email"         => "marketing@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userMarketings->roles()->attach($roleMarketings->id);

        $userProduction = User::create([
            "first_name"    => "HOD",
            "last_name"     => "Production",
            "username"      => "production",
            "email"         => "production@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userProduction->roles()->attach($roleProductions->id);

        $userCustomerService = User::create([
            "first_name"    => "Customer",
            "last_name"     => "Service",
            "username"      => "customer_service",
            "email"         => "customer_service@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userCustomerService->roles()->attach($roleSecretaries->id);

        $userCustomerCare = User::create([
            "first_name"    => "Customer",
            "last_name"     => "Care",
            "username"      => "customer_care",
            "email"         => "customer_care@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userCustomerCare->roles()->attach($roleMarketings->id);

        $userScretaryAdmin = User::create([
            "first_name"    => "Secretary",
            "last_name"     => "Admin",
            "username"      => "secretary_admin",
            "email"         => "secretary_admin@email.com",
            "password"      => "Password1",
            "auth_type"     => "internal",
            "enabled"       => true
            ]);
        $userScretaryAdmin->roles()->attach($roleSecretaries->id);
    }
}
