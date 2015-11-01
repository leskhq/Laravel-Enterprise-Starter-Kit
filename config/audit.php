<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | The Audit functionality is disabled by default, to enabled it set
    | the variable 'AUDIT_ENABLED' to true in your '.env' file.
    |
    */

    'enabled' => env('AUDIT_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Purge retention
    |--------------------------------------------------------------------------
    |
    | How many days of audit to keep when doing a purge? The default is
    | 365 days or one year.
    |
    */

    'purge_retention' => env('AUDIT_PURGE_RETENTION', 365),

];

