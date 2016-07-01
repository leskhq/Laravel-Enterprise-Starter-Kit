<?php

return [

    'audit-log'           => [
        'category'          => 'Audit log',
        'msg-index'         => 'Access audit log.',
        'msg-show'          => 'Accessed details of audit log.',
        'msg-purge'         => 'Purge old entries from audit log.',
        'msg-replay'        => 'Trigger replay on audit log item ID #:ID.',
    ],

    'status'              => [
        'purged'              => 'Audit log purged',
    ],

    'error'               => [
        'no-replay-available'   => 'No replay action available.',
        'no-data-viewer'        => 'No data viewer defined.',
        'no-data'               => 'No data to show.',
    ],

    'page'                => [
        'index'               => [
            'title'               => 'Admin | Audit log',
            'description'         => 'log of all actions performed by users',
            'table-title'         => 'Audit log',
        ],
        'show'              => [
            'title'             => 'Admin | Audit log | Show',
            'description'       => 'Displaying Audit log',
            'section-title'     => 'Audit log details'
        ],
    ],

    'columns'             => [
        'username'            =>  'User name',
        'category'            =>  'Category',
        'message'             =>  'Message',
        'date'                =>  'Date',
        'data'                =>  'Data',
        'actions'             =>  'Actions',
    ],

    'button'              => [
        'purge'               => 'Purge entries older than :purge_retention days',
    ],

];
