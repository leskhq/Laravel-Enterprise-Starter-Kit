<?php

return [

    'status'              => [
        'purged'              => 'Audit log purged',
    ],

    'error'               => [
    ],

    'page'                => [
        'index'               => [
            'title'               => 'Admin | Audit log',
            'description'         => 'log of all actions performed by users',
            'table-title'         => 'Audit log',
        ],
    ],

    'columns'             => [
        'username'            =>  'User name',
        'category'            =>  'Category',
        'message'             =>  'Message',
        'date'                =>  'Date',
        'actions'             =>  'Actions',
    ],

    'button'              => [
        'purge'               => 'Purge entries older than :purge_retention days',
    ],

];
