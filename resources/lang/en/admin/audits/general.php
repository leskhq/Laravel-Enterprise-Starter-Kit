<?php

return [

    'status'              => [
        'purged'                   => 'Audit successfully purged',
    ],

    'error'              => [
        'no-data-viewer'            => 'No data viewer provided.',
    ],

    'columns'              => [
        'username'               => 'User name',
        'method'                 => 'Method',
        'route_action'           => 'Action',
        'date'                   => 'Date',
        'data'                   => 'Data',
        'route_name'             => 'Route name',
        'user_agent'             => 'User agent',
        'ip'                     => 'IP',
        'device'                 => 'Device',
        'platform'               => 'Platform',
        'browser'                => 'Browser',
        'is_desktop'             => 'Is desktop',
        'is_mobile'              => 'Is mobile',
        'is_phone'               => 'Is phone',
        'is_tablet'              => 'Is tablet',

    ],

    'action'              => [
        'purge'                             => 'Purge entries older than :purge_retention days',
        'no-permission-to-purge-audits'     => 'You do not have permissions to purge the audit log',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Audits',
            'description'       => 'List of audit entries',
            'table-title'       => '',
        ],
        'show'              => [
            'title'             => 'Admin | Audits | Show',
            'description'       => 'Displaying audit details',
            'section-title'     => ''
        ],
    ],

];
