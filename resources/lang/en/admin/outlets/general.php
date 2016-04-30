<?php

return [

    'audit-log'           => [
        'category'              => 'Outlets',
        'msg-index'             => 'Accessed list of outlets.',
        'msg-show'              => 'Accessed details of outlet: :name.',
        'msg-store'             => 'Created new outlet: :name.',
        'msg-edit'              => 'Initiated edit of outlet: :name.',
        'msg-update'            => 'Submitted edit of outlet: :name.',
        'msg-destroy'           => 'Deleted outlet: :name.',
        'msg-generate'          => 'Triggered generation of outlets based on routes.',
        'msg-enable'            => 'Enabled outlet: :name.',
        'msg-disabled'          => 'Disabled outlet: :name.',
        'msg-enabled-selected'  => 'Enabled multiple outlets.',
        'msg-disabled-selected' => 'Disabled multiple outlets.',
    ],

    'status'              => [
        'created'                   => 'Outlet successfully created',
        'updated'                   => 'Outlet successfully updated',
        'deleted'                   => 'Outlet successfully deleted',
        'generated'                 => 'Successfully generated :number outlets from routes.',
        'global-enabled'            => 'Selected outlets enabled.',
        'global-disabled'           => 'Selected outlets disabled.',
        'enabled'                   => 'Outlet enabled.',
        'disabled'                  => 'Outlet disabled.',
        'no-outlet-selected'        => 'No outlet selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This outlet cannot be deleted',
        'cant-delete-perm-in-use'     => 'This outlet is in use or protected',
        'cant-edit-this-permission'   => 'This outlet cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Outlets',
            'description'       => 'List of outlets',
            'table-title'       => 'Outlet list',
        ],
        'show'              => [
            'title'             => 'Admin | Outlet | Show',
            'description'       => 'Displaying outlet: :name',
            'section-title'     => 'Outlet details'
        ],
        'create'            => [
            'title'            => 'Admin | Outlet | Create',
            'description'      => 'Creating a new outlet',
            'section-title'    => 'New outlet'
        ],
        'edit'              => [
            'title'            => 'Admin | Outlet | Edit',
            'description'      => 'Editing outlet: :name',
            'section-title'    => 'Edit outlet'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'user_id'                   =>  'User',
        'name'                      =>  'Name',
        'email'                     =>  'Email',
        'phone'                     =>  'Phone',
        'address'                   =>  'Address',
        'description'               =>  'Description',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
    ],

    'action'               => [
        'create'                => 'Create new outlet',
        'generate'              => 'Generate outlets',
    ],

];
