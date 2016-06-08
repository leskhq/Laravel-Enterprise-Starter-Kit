<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites_meta', function (Blueprint $table) {
        $table->increments('id');

        $table->integer('site_id')->unsigned()->index();
        $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');

        $table->string('type')->default('null');

        $table->string('key')->index();
        $table->text('value')->nullable();

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
         Schema::drop('sites_meta');
    }
}
