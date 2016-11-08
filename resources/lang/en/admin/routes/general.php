<?php

return [

    'audit-log'           => [
        'category'              => 'Routes',
        'msg-index'             => 'Accessed list of routes.',
        'msg-show'              => 'Accessed details of route: :name.',
        'msg-store'             => 'Created new route: :name.',
        'msg-edit'              => 'Initiated edit of route: :name.',
        'msg-update'            => 'Submitted edit of route: :name.',
        'msg-destroy'           => 'Deleted route: :name.',
        'msg-enable'            => 'Enabled route: :name.',
        'msg-disabled'          => 'Disabled route: :name.',
        'msg-load'              => 'Triggered loading of application routes from Laravel routes.',
        'msg-save-perms'        => 'Assign permission to multiple routes.',
        'msg-enabled-selected'  => 'Enabled multiple routes.',
        'msg-disabled-selected' => 'Disabled multiple routes.',
    ],

    'status'              => [
        'created'                           => 'Route successfully created',
        'updated'                           => 'Route successfully updated',
        'deleted'                           => 'Route successfully deleted',
        'synced'                            => 'Successfully loaded :nbLoaded routes from application, and deleted :nbDeleted unused routes from the database.',
        'indiv-perms-assigned'              => 'Individual routes permission assignment saved.',
        'global-perms-assigned'             => 'Selected routes permission assignment saved.',
        'no-permission-changed-detected'    => 'No permission change detected.',
        'global-enabled'                    => 'Selected routes enabled.',
        'global-disabled'                   => 'Selected routes disabled.',
        'enabled'                           => 'Routes enabled.',
        'disabled'                          => 'Routes disabled.',
        'no-route-selected'                 => 'No route selected.',
    ],

    'error'               => [
        'cant-delete-this-role' => 'This role cannot be deleted',
        'cant-edit-this-role'   => 'This role cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Routes',
            'description'       => 'List of routes',
            'table-title'       => 'Route list',
        ],
        'show'              => [
            'title'             => 'Admin | Route | Show',
            'description'       => 'Displaying route',
            'section-title'     => 'Route details'
        ],
        'create'            => [
            'title'            => 'Admin | Route | Create',
            'description'      => 'Creating a new route',
            'section-title'    => 'New route'
        ],
        'edit'              => [
            'title'            => 'Admin | Route | Edit',
            'description'      => 'Editing route',
            'section-title'    => 'Edit route'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'action_name'               =>  'Action name',
        'method'                    =>  'Method',
        'path'                      =>  'Path',
        'permission'                =>  'Permission',
        'slug'                      =>  'Slug',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'enabled'                   =>  'Enabled',
    ],

    'action'               => [
        'load-routes'           => 'Load routes from Laravel routes table',
        'create'                => 'Create new route',
        'enable-selected'       => 'Enable selected route',
        'disable-selected'      => 'Disable selected route',
        'save-perms-assignment' => 'Save permission assignments',
    ],

    'placeholder'   => [
        'select-permission' => 'Select permission',
    ],

];
