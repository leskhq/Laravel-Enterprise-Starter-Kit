<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreAffiliateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create affiliate table
        Schema::create('affiliates', function (Blueprint $table) {
            $table->incremant('id');
            $table->unsignedInteger('user_id');
            $table->integer('balance');
            $table->integer('click');
            $table->string('link');
            $table->timestamps();
        });

        // create store customer table
        Schema::create('store_customers', function (Blueprint $table) {
            $table->incremant('id');
            $table->unsignedInteger('user_id');
            $table->integer('aff_id');
            $table->string('address');
            $table->string('ship_address');
            $table->text('phone');
            $table->timestamps();
        });

        // create store order table
        Schema::create('store_orders', function (Blueprint $table) {
            $table->increment('id');
            $table->unsignedInteger('store_customer_id');
            $table->text('address');
            $table->text('phone');
            $table->integer('total');
            $table->timestamps();
        });

        // create store order detail table
        Schema::create('store_order_details', function (Blueprint $table) {
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('total');
            $table->string('description');
        });

        // create ip addresses table
        Schema::create('ip_addresses', function (Blueprint $table) {
            $table->unsignedInteger('ip');
            $table->string('link');
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
        Schema::drop('affiliates');
        Schema::drop('store_custoemrs');
        Schema::drop('store_orders');
        Schema::drop('store_order_details');
        Schema::drop('ip_addresses');
    }
}
