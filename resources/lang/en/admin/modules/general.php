<?php

return [

    'audit-log'           => [
        'category'              => 'Modules',
        'msg-index'             => 'Accessed list of modules.',
        'msg-show'              => 'Accessed details of permission: :name.',
        'msg-store'             => 'Created new permission: :name.',
        'msg-edit'              => 'Initiated edit of permission: :name.',
        'msg-update'            => 'Submitted edit of permission: :name.',
        'msg-destroy'           => 'Deleted permission: :name.',
        'msg-generate'          => 'Triggered generation of permissions based on routes.',
        'msg-enable'            => 'Enabled module: :slug.',
        'msg-disabled'          => 'Disabled module: :slug.',
        'msg-enabled-selected'  => 'Enabled multiple modules.',
        'msg-disabled-selected' => 'Disabled multiple modules.',
        'msg-optimizer'         => 'Optimized modules definition.',
        'msg-initialize'        => 'Initialized module: :slug.',
        'msg-uninitialize'      => 'Uninitialized module: :slug.',
    ],

    'status'              => [
        'global-enabled'            => 'Selected modules enabled.',
        'global-disabled'           => 'Selected modules disabled.',
        'enabled'                   => 'Module enabled.',
        'disabled'                  => 'Module disabled.',
        'optimized'                 => 'Modules definition optimized.',
        'initialized'               => 'Module initialized: :name.',
        'uninitialized'             => 'Module uninitialized: :name.',
        'no-mod-selected'           => 'No module selected.',
        'already-initialized'       => 'Module already initialized: :name.',
        'not-initialized'           => 'Module not initialized: :name.',
        'not-disabled'              => 'Module not disabled: :name.',
        'not-found'                 => 'Module not found: :slug.',
    ],

    'error'               => [
        'cant-enable-this-module'       => 'This module cannot be enabled until it is initialized.',
        'cant-uninitialize-this-module' => 'This module cannot be uninitialized until it is disabled.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Modules',
            'description'       => 'List of modules',
            'table-title'       => 'Module list',
        ],
        'show'              => [
            'title'             => 'Admin | Permission | Show',
            'description'       => 'Displaying permission: :name',
            'section-title'     => 'Permission details'
        ],
        'create'            => [
            'title'            => 'Admin | Permission | Create',
            'description'      => 'Creating a new permission',
            'section-title'    => 'New permission'
        ],
        'edit'              => [
            'title'            => 'Admin | Permission | Edit',
            'description'      => 'Editing permission: :name',
            'section-title'    => 'Edit permission'
        ],
    ],

    'columns'           => [
        'order'                     =>  'Order',
        'name'                      =>  'Name',
        'display_name'              =>  'Display name',
        'description'               =>  'Description',
        'routes'                    =>  'Routes',
        'roles'                     =>  'Roles',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
    ],

    'action'               => [
        'create'                => 'Create new permission',
        'generate'              => 'Generate permissions',
    ],

    'button'               => [
        'optimize'      =>  'Optimize module definition',
        'initialize'    =>  'Initialize',
        'uninitialize'  =>  'Uninitialize',
    ],

    'delete-confirm'              => [
        'title'   => 'Uninitialize module',
        'body'    => 'Are you sure that you want to uninitialize the module named ":name"? <br/> In many cases the uninitialize call to a module will have it delete or clean-up all it\'s data from the internal database, causing the module\'s data to be lost. Do you have a backup just in case? This operation may be irreversible. <br/> For more information please refer the the module\'s documentation.',
    ],

];
