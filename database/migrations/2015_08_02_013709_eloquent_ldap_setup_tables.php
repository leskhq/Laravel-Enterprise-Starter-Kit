<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EloquentLdapSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //======
        // USERS
        //======
        // Either uncomment the section below to create the users table if it
        // was not already done before, or use it as an example for your own
        // migration.
//        // Create users table
//        Schema::create('users', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('first_name');
//            $table->string('last_name');
//            $table->string('username')->unique();
//            $table->string('email')->unique();
//            $table->string('password', 60);
//            $table->rememberToken();
//            $table->timestamps();
//        });

        // USERS: Add the auth_type column.
        Schema::table('users', function (Blueprint $table) {
            $table->string('auth_type')->nullable();
        });

        //=======
        // GROUPS
        //=======
        // Either uncomment the section below to create the groups table if it
        // was not already done before, or use it as an example for your own
        // migration.
//        // Create table for storing groups
//        Schema::create('groups', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name')->unique();
//            $table->string('display_name')->nullable();
//            $table->string('description')->nullable();
//            $table->timestamps();
//        });
//
//        // Create table for associating groups to users (Many-to-Many)
//        Schema::create('group_user', function (Blueprint $table) {
//            $table->integer('user_id')->unsigned();
//            $table->integer('group_id')->unsigned();
//
//            $table->foreign('user_id')->references('id')->on('users')
//                ->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('group_id')->references('id')->on('groups')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->primary(['user_id', 'group_id']);
//        });

        // GROUPS: Add the resync_on_login column.
        Schema::table('roles', function (Blueprint $table) {
            $table->boolean('resync_on_login')->default(false);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auth_type');
        });

        // Uncomment the section below if the users table was created above.
//        // Drop the users table.
//        Schema::drop('users');

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('resync_on_login');
        });

        // Uncomment the section below if the groups table was created above.
//        // Drop the groups table.
//        Schema::drop('groups');
//        // Drop the group user link table.
//        Schema::drop('group_user');
    }
}
