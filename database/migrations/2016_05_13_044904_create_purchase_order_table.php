<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('status')->default(1);
            $table->integer('supplier_id')->unsigned();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->decimal('quantity', 10, 2);
            $table->boolean('accepted')->default(0);
            $table->text('description')->nullable();

            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')
                ->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_orders');
        Schema::drop('purchase_order_details');
    }
}
