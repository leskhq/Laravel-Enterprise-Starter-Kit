<?php

return [

    'status'              => [
        'purged'                   => 'Audit successfully purged',
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
