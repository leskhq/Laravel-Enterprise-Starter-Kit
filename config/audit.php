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

    'enabled' => env('audit.enabled', false),

    /*
    |--------------------------------------------------------------------------
    | Purge retention
    |--------------------------------------------------------------------------
    |
    | How many days of audit to keep when doing a purge? The default is
    | 365 days or one year.
    |
    */

    'purge_retention' => env('audit.purge_retention', 365),

];

