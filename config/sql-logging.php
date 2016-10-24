<?php
return [

    /*
      |--------------------------------------------------------------------------
      | SQL logging enable
      |--------------------------------------------------------------------------
      |
      | Enable or disable the SQL logging
      |
     */
    'log'         => env('sql-logging.log',         false),
    'log_request' => env('sql-logging.log_request', true),
];