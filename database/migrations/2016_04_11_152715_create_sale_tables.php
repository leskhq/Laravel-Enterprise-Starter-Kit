<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->date('order_date');
            $table->date('transfer_date')->nullable()->default(null);
            $table->date('ship_date')->nullable()->default(null);
            $table->date('estimation_date')->nullable()->default(null);
            $table->string('transfer_via')->nullable();
            $table->integer('status')->default(1);
            $table->integer('discount')->nullable();
            $table->integer('nominal');
            $table->integer('shipping_fee')->nullable();
            $table->integer('packing_fee')->nullable();
            $table->string('expedition')->nullable();
            $table->string('resi')->nullable();
            $table->text('description')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('price');
            $table->decimal('quantity', 10, 2);
            $table->integer('total');
            $table->integer('weight')->nullable();
            $table->text('description')->nullable();

            $table->foreign('sale_id')->references('id')->on('sales')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
        Schema::drop('sale_details');
    }
}
