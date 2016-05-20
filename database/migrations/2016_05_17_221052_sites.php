<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('address', 64);
            $table->string('city', 64);
            $table->string('state', 2);
            $table->decimal('area', 7, 2);
            $table->tinyInteger('status')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('zip_code', 5);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('sites');
    }
}
