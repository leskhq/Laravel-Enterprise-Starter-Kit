<?php

return [

    'audit-log'           => [
        'category'              => 'Permissions',
        'msg-index'             => 'Accessed list of permissions.',
        'msg-show'              => 'Accessed details of permission: :name.',
        'msg-store'             => 'Created new permission: :name.',
        'msg-edit'              => 'Initiated edit of permission: :name.',
        'msg-update'            => 'Submitted edit of permission: :name.',
        'msg-destroy'           => 'Deleted permission: :name.',
        'msg-generate'          => 'Triggered generation of permissions based on routes.',
        'msg-enable'            => 'Enabled permission: :name.',
        'msg-disabled'          => 'Disabled permission: :name.',
        'msg-enabled-selected'  => 'Enabled multiple permissions.',
        'msg-disabled-selected' => 'Disabled multiple permissions.',
    ],

    'status'              => [
        'created'                   => 'Permission successfully created',
        'updated'                   => 'Permission successfully updated',
        'deleted'                   => 'Permission successfully deleted',
        'generated'                 => 'Successfully generated :number permissions from routes.',
        'global-enabled'            => 'Selected permissions enabled.',
        'global-disabled'           => 'Selected permissions disabled.',
        'enabled'                   => 'Permission enabled.',
        'disabled'                  => 'Permission disabled.',
        'no-perm-selected'          => 'No permission selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This permission cannot be deleted',
        'cant-delete-perm-in-use'     => 'This permission is in use or protected',
        'cant-edit-this-permission'   => 'This permission cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Permissions',
            'description'       => 'List of permissions',
            'table-title'       => 'Permission list',
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
        'id'                        =>  'ID',
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

];
