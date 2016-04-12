<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address');
            $table->string('laundry_name')->nullable();
            $table->text('laundry_address')->nullable();
            $table->integer('type');
            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        Schema::create('customer_candidates', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address');
            $table->integer('type');
            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        Schema::create('customer_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->text('content');

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('customer_candidate_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_candidate_id')->unsigned();
            $table->text('content');

            $table->timestamps();

            $table->foreign('customer_candidate_id')->references('id')->on('customer_candidates')
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
        Schema::drop('customers');
        Schema::drop('customer_candidates');
        Schema::drop('customer_followups');
        Schema::drop('customer_candidate_followups');
    }
}
