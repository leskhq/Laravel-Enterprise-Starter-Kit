<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnabledFieldToAuthorizationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->boolean('enabled')->default(false);
        });
        Schema::table('routes', function ($table) {
            $table->boolean('enabled')->default(false);
        });
        Schema::table('roles', function ($table) {
            $table->boolean('enabled')->default(false);
        });
        Schema::table('permissions', function ($table) {
            $table->boolean('enabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('enabled');
        });
        Schema::table('routes', function ($table) {
            $table->dropColumn('enabled');
        });
        Schema::table('roles', function ($table) {
            $table->dropColumn('enabled');
        });
        Schema::table('permissions', function ($table) {
            $table->dropColumn('enabled');
        });
    }
}
