<?php

return [

    'audit-log'           => [
        'category'          => 'Error log',
        'msg-index'         => 'Access error log.',
        'msg-show'          => 'Accessed details of error.',
        'msg-purge'         => 'Purge old entries from error log.',
    ],

    'status'              => [
        'purged'              => 'Error log purged',
    ],

    'error'               => [
        'no-data'               => 'No data to show.',
    ],

    'page'                => [
        'index'               => [
            'title'               => 'Admin | Error log',
            'description'         => 'log of all errors generated and logged',
            'table-title'         => 'Error log',
        ],
        'show'              => [
            'title'             => 'Admin | Error log | Show',
            'description'       => 'Displaying Error ID: :error_id',
            'section-title'     => 'Error details'
        ],
    ],

    'columns'             => [
        'user'                =>  'User',
        'message'             =>  'Message',
        'class'               =>  'Class',
        'url'                 =>  'URL',
        'date'                =>  'Date',
        'file'                =>  'File',
        'code'                =>  'Code',
        'status_code'         =>  'Status code',
        'line'                =>  'Line',
        'trace'               =>  'Trace',
        'data'                =>  'Data',
        'method'              =>  'Method',
    ],

    'button'              => [
        'purge'               => 'Purge entries older than :purge_retention days',
    ],

];
