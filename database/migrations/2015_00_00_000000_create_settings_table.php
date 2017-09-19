<?php

use Arcanedev\Support\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSettingsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateSettingsTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateSettingsTable constructor.
     */
    public function __construct()
    {
        $this->setConnection(config('settings.drivers.database.options.connection'));
        $this->setTable(config('settings.drivers.database.options.table', 'settings'));
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createSchema(function(Blueprint $table) {
            $table->unsignedInteger('user_id')->default(0);
            $table->string('key');
            $table->text('value');
            $table->timestamps();

            $table->unique(['user_id', 'key']);
        });
    }
}
