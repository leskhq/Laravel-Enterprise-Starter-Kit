<?php

use Arcanedev\Support\Bases\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSettingsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateSettingsTable extends Migration
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->connection = config('settings.stores.database.connection');
        $this->table      = config('settings.stores.database.table');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->createSchema(function(Blueprint $table) {
            $table->increments('id');
            $table->string('key')->index();
            $table->text('value');
        });
    }
}
