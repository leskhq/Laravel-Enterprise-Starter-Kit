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
    'log' => env('SQL-LOGGING.LOG', false),
    'log_request' => env('SQL-LOGGING.LOG_REQUEST', true),
];