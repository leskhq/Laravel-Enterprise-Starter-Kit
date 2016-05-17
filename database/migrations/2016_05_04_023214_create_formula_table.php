<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('formula_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formula_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('quantity');

            $table->foreign('formula_id')->references('id')->on('formulas')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('formulas');
        Schema::drop('formula_details');
    }
}
