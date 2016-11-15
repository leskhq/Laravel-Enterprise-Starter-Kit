<?php

return [

    'audit-log'           => [
        'category'              => 'Settings',
        'msg-index'             => 'Accessed list of settings.',
        'msg-show'              => 'Accessed details of setting: :key.',
        'msg-store'             => 'Created new setting: :key.',
        'msg-edit'              => 'Initiated edit of setting: :key.',
        'msg-update'            => 'Submitted edit of setting: :key.',
        'msg-destroy'           => 'Deleted setting: :key.',
        'msg-load'              => 'Triggered loading of settings based on \'.env\' file.',
    ],

    'status'              => [
        'created'                   => 'Setting successfully created',
        'updated'                   => 'Setting successfully updated',
        'deleted'                   => 'Setting successfully deleted',
        'settings-loaded'           => 'Successfully loaded :number settings from :env file.',
        'no-settings-loaded'        => 'Nothing loaded from :env settings file.',
        'settings-file-not-found'   => 'Could not find :env settings file.',
        'no-setting-selected'       => 'No setting selected.',
    ],

    'error'               => [
        'cant-edit-this-setting'   => 'This setting cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Setting',
            'description'       => 'List of settings',
            'table-title'       => 'Setting list',
        ],
        'show'              => [
            'title'             => 'Admin | Setting | Show',
            'description'       => 'Displaying setting: :key',
            'section-title'     => 'Setting details'
        ],
        'create'            => [
            'title'            => 'Admin | Setting | Create',
            'description'      => 'Creating a new setting',
            'section-title'    => 'New setting'
        ],
        'edit'              => [
            'title'            => 'Admin | Setting | Edit',
            'description'      => 'Editing setting: :key',
            'section-title'    => 'Edit setting'
        ],
    ],

    'columns'           => [
        'name'                      =>  'Name',
        'value'                     =>  'Value',
        'actions'                   =>  'Actions',
        'encrypted'                 =>  'Encrypted',
    ],

    'action'               => [
        'create'                => 'Create new setting',
        'load'                  => 'Load settings',
    ],

];
