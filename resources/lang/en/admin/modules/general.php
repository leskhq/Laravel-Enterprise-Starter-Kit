<?php

return [

    'audit-log'           => [
        'category'              => 'Modules',
        'msg-index'             => 'Accessed list of modules.',
        'msg-initialize'        => 'Initialize module.',
        'msg-uninitialize'      => 'Un-initialize module.',
        'msg-enable'            => 'Enabled module.',
        'msg-disabled'          => 'Disabled module.',
    ],

    'button'              => [
        'initialize'               => 'Initialize',
        'uninitialize'             => 'Un-initialize',
        'enable'                   => 'Enable',
        'disable'                  => 'Disable',
        'optimize'                 => 'Optimize module definition',
    ],

    'status'              => [
        'initialized'               => 'Module ":name" initialized.',
        'uninitialized'             => 'Module ":name" un-initialized.',
        'enabled'                   => 'Module ":name" enabled.',
        'disabled'                  => 'Module ":name" disabled.',
        'optimized'                 => 'Modules definition optimized.',
    ],

    'error'               => [
        'cant-uninitialize-an-enabled-module' => 'Cannot un-initialize an enabled module.',
        'cant-uninitialize-no-permission'     => 'Cannot un-initialize module, permission missing.',
        'cant-initialize-no-permission'       => 'Cannot initialize module, permission missing.',
        'cant-disable-no-permission'          => 'Cannot disable module, permission missing.',
        'cant-enable-no-permission'           => 'Cannot enable module, permission missing.',
        'cant-enable-uninitialized-module'    => 'Cannot enable an un-initialized module.',
        'already-initialized'                 => 'Module :name already initialized.',
        'not-found'                           => 'Module :slug not found, operation failed.',
        'no-permission-to-optimize-modules'   => 'Cannot optimize module definition, permission missing.'
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Modules',
            'description'       => 'List of modules',
            'table-title'       => '',
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'description'               =>  'Description',
        'actions'                   =>  'Actions',
        'assigned'                  =>  'Assigned',
    ],

    'action'               => [
        'optimize'              => 'Optimize module definition.',
    ],

];
