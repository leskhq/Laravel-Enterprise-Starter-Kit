<?php

return [

    'audit-log'           => [
        'category'              => 'Routes',
        'msg-index'             => 'Accessed list of Routes.',
        'msg-show'              => 'Accessed details of Route.',
        'msg-create'            => 'Initiated creation of new Route.',
        'msg-store'             => 'Created new Route.',
        'msg-edit'              => 'Initiated edit of Route.',
        'msg-update'            => 'Submitted edit of Route.',
        'msg-get-modal-delete'  => 'Request delete Route confirmation.',
        'msg-destroy'           => 'Deleted Route.',
        'msg-enable'            => 'Enabled Route.',
        'msg-disabled'          => 'Disabled Route.',
        'msg-enabled-selected'  => 'Enabled multiple selected Route.',
        'msg-disabled-selected' => 'Disabled multiple selected Route.',
        'msg-load'              => 'Loaded routes from application.',
        'msg-save-perms'        => 'Saved permission assignment for routes.',
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
        'assigned'                  =>  'Assigned',
    ],

    'action'               => [
        'load-routes'                               => 'Load routes from Laravel routes table',
        'no-permission-to-load-routes'              => 'No permissions to load routes from Laravel routes table',
        'create'                                    => 'Create new route',
        'enable-selected'                           => 'Enable selected route',
        'disable-selected'                          => 'Disable selected route',
        'save-perms-assignment'                     => 'Save permission assignments',
        'no-permission-to-save-perms-assignment'    => 'You do not have permissions to save permission assignment.'
    ],

    'placeholder'   => [
        'select-permission' => 'Select permission',
    ],

];
