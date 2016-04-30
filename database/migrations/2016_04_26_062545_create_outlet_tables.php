<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_laundries', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('outlet_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_laundry_id')->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();

            $table->foreign('outlet_laundry_id')->references('id')->on('users');
        });

        Schema::create('outlet_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_laundry_id')->unsigned();
            $table->decimal('kilo_quantity')->nullable();
            $table->integer('kilo_total')->nullable();
            $table->integer('piece_quantity')->nullable();
            $table->integer('piece_total')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('outlet_laundry_id')->references('id')->on('outlet_laundries')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('outlet_laundries');
        Schema::drop('outlet_customers');
        Schema::drop('outlet_sales');
    }
}
