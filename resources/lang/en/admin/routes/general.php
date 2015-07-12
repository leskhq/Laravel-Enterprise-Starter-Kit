<?php

return [

    'status'              => [
        'created'                           => 'Route successfully created',
        'updated'                           => 'Route successfully updated',
        'deleted'                           => 'Route successfully deleted',
        'loaded'                            => 'Successfully loaded :number routes from application.',
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
    ],

    'action'               => [
        'load-routes'           => 'Load routes',
        'save-perms-assignment' => 'Save permission assignments',
    ],


];
