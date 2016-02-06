<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->unsignedInteger('position')->default(0);
            $table->string('icon')->nullable();
            $table->boolean('separator')->default(false);
            $table->string('url')->nullable()->default(null);
            $table->boolean('enabled')->default(false);
            $table->unsignedInteger('parent_id')->default(0);
            $table->unsignedInteger('route_id')->nullable()->default(null);
            $table->unsignedInteger('permission_id')->nullable()->default(null);

            $table->timestamps();

//            $table->foreign('parent_id')->references('id')->on('menus');
//            $table->foreign('route_id')->references('id')->on('routes');
//            $table->foreign('permission_id')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
