<?php

return [

    'audit-log'           => [
        'category'          => 'Audit log',
        'msg-index'         => 'Access audit log.',
        'msg-purge'         => 'Purge old entries from audit log.',
        'msg-replay'        => 'Trigger replay on audit log item ID #:ID.',
    ],

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
