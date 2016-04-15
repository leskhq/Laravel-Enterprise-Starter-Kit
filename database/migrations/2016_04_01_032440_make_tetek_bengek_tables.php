<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTetekBengekTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expeditions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->text('contact')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });

        Schema::create('perfumes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('category');
            $table->boolean('status')->default(false);
            $table->text('contact')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('category');
            $table->integer('type');
            $table->integer('hpp');
            $table->integer('price');
            $table->integer('agenresmi_price')->nullable();
            $table->integer('agenlepas_price')->nullable();
            $table->integer('distributor_price')->nullable();
            $table->integer('hpp_max')->nullable();
            $table->integer('stock')->default(1);
            $table->float('weight')->nullable();
            $table->string('image')->nullable();
            $table->integer('perfume_id')->unsigned()->nullable();
            $table->integer('supplier_id')->nullable()->unsigned();
            $table->boolean('published')->default(true);
            $table->integer('odr')->nullable();
            $table->text('description')->nullable();

            // $table->foreign('perfume_id')->references('id')->on('perfumes');
            // $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('stock')->default(1);
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('bank_name');
            $table->integer('account_number');

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
        Schema::drop('expeditions');
        Schema::drop('perfumes');
        Schema::drop('suppliers');
        Schema::drop('products');
        Schema::drop('materials');
        Schema::drop('bank_accounts');
    }
}
