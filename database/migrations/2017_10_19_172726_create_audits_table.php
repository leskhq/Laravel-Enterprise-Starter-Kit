<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->string    ('category'     )->nullable()->default(null);
            $table->string    ('message'      )->nullable()->default(null);
            $table->integer   ('user_id'      )->nullable()->default(null);
            $table->string    ('method'       )->nullable()->default(null);
            $table->string    ('path'         )->nullable()->default(null);
            $table->string    ('route_name'   )->nullable()->default(null);
            $table->string    ('route_action' )->nullable()->default(null);
            $table->text      ('query'        )->nullable()->default(null);
            $table->longText  ('data'         )->nullable()->default(null);
            $table->string    ('userAgent'    )->nullable()->default(null);
            $table->string    ('ip', 20)->nullable()->default(null);
            $table->string    ('device'       )->nullable()->default(null);
            $table->string    ('platform'     )->nullable()->default(null);
            $table->string    ('browser'      )->nullable()->default(null);
            $table->boolean   ('isDesktop'    )->nullable()->default(false);
            $table->boolean   ('isMobile'     )->nullable()->default(false);
            $table->boolean   ('isPhone'      )->nullable()->default(false);
            $table->boolean   ('isTablet'     )->nullable()->default(false);
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
        Schema::dropIfExists('audits');
    }
}
