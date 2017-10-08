<?php

return [
    /*
     * Whether all SQL queries should be logged
     */
    'log_queries' => env('SQL_LOG_QUERIES', true),

    /*
     * Whether artisan queries should be logged to separate files
     */
    'log_console_to_separate_file' => env('SQL_LOG_SEPARATE_ARTISAN', false),

    /*
     * Whether slow SQL queries should be logged (you can log all queries and
     * also slow queries in separate file or you might to want log only slow
     * queries)
     */
    'log_slow_queries' => env('SQL_LOG_SLOW_QUERIES', true),

    /*
     * Time of query (in milliseconds) when this query is considered as slow
     */
    'slow_queries_min_exec_time' => env('SQL_SLOW_QUERIES_MIN_EXEC_TIME', 100),

    /*
     * Whether log (for all queries, not for slow queries) should be overridden.
     * It might be useful when you test some functionality and you want to
     * compare your queries (or number of queries) - be aware that when using
     * AJAX it will override your log file in each request
     */
    'override_log' => env('SQL_LOG_OVERRIDE', false),

    /*
     * Directory where log files will be saved
     */
    'directory' => storage_path(env('SQL_LOG_DIRECTORY', 'logs/sql')),

    /*
     * Whether execution time in log file should be displayed in seconds
     * (by default it's in milliseconds)
     */
    'convert_to_seconds' => env('SQL_CONVERT_TIME_TO_SECONDS', false),
];
