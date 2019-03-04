<?php

return [

    'audit-log'           => [
        'category'            => 'Error log',
        'msg-index'           => 'Access error log list.',
        'msg-show'            => 'Accessed details of error log.',
        'msg-purge'           => 'Purge old entries from error log.',
        'msg-get-modal-purge' => 'Request error log purge confirmation.',
    ],

    'status'              => [
        'purged'                   => 'Error successfully purged',
    ],

    'error'              => [
        'no-data-viewer'            => 'No data viewer provided.',
    ],

    'columns'              => [
        'username'               => 'User name',
        'user'                   => 'User',
        'method'                 => 'Method',
        'date'                   => 'Date',
        'data'                   => 'Data',
        'class'                  => 'Class',
        'message'                => 'Message',
        'url'                    => 'URL',
        'file'                   => 'File',
        'code'                   => 'Code',
        'status_code'            => 'Status code',
        'line'                   => 'Line',
        'trace'                  => 'Trace',
        'ip'                     => 'IP',

    ],

    'action'              => [
        'purge'                             => 'Purge entries older than :purge_retention days',
        'no-permission-to-purge-errors'     => 'You do not have permissions to purge the error log',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Errors',
            'description'       => 'List of error entries',
            'table-title'       => '',
        ],
        'show'              => [
            'title'             => 'Admin | Errors | Show',
            'description'       => 'Displaying error details',
            'section-title'     => ''
        ],
    ],

];