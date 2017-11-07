<?php

return [

    'audit-log'           => [
        'category'                       => 'Settings',
        'msg-index'                      => 'Accessed list of Settings.',
        'msg-show'                       => 'Accessed details of Setting.',
        'msg-create'                     => 'Initiated creation of new Setting.',
        'msg-store'                      => 'Created new Setting.',
        'msg-edit'                       => 'Initiated edit of Setting.',
        'msg-update'                     => 'Submitted edit of Setting.',
        'msg-get-modal-delete'           => 'Request delete Setting confirmation.',
        'msg-get-modal-delete-selected'  => 'Request delete confirmation for multiple selected Settings.',
        'msg-destroy'                    => 'Deleted Setting.',
        'msg-destroy-selected'           => 'Deleted multiple selected Settings.',
        'msg-load'                       => 'Loaded Settings from file.',
    ],

    'status'              => [
        'created'                   => 'Setting successfully created.',
        'updated'                   => 'Setting successfully updated.',
        'deleted'                   => 'Setting successfully deleted.',
        'settings-loaded'           => 'Successfully loaded :number settings from :env file.',
        'no-settings-loaded'        => 'Nothing loaded from :env settings file.',
        'settings-file-not-found'   => 'Could not find :env settings file.',
        'no-setting-selected'       => 'No setting selected.',
        'selected-settings-deleted' => 'Selected settings successfully deleted.',
    ],

    'error'               => [
        'cant-edit-this-setting'             => 'This setting cannot be edited',
        'no-permission-to-delete-settings'   => 'You do not have permissions to delete settings',
        'no-permission-to-update-settings'   => 'You do not have permissions to edit settings',
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
