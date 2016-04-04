<?php

return [

    'audit-log'           => [
        'category'              => 'Suppliers',
        'msg-index'             => 'Accessed list of suppliers.',
        'msg-show'              => 'Accessed details of supplier: :name.',
        'msg-store'             => 'Created new supplier: :name.',
        'msg-edit'              => 'Initiated edit of supplier: :name.',
        'msg-update'            => 'Submitted edit of supplier: :name.',
        'msg-destroy'           => 'Deleted supplier: :name.',
        'msg-generate'          => 'Triggered generation of suppliers based on routes.',
        'msg-enable'            => 'Enabled supplier: :name.',
        'msg-disabled'          => 'Disabled supplier: :name.',
        'msg-enabled-selected'  => 'Enabled multiple suppliers.',
        'msg-disabled-selected' => 'Disabled multiple suppliers.',
    ],

    'status'              => [
        'created'                   => 'Supplier successfully created',
        'updated'                   => 'Supplier successfully updated',
        'deleted'                   => 'Supplier successfully deleted',
        'generated'                 => 'Successfully generated :number suppliers from routes.',
        'global-enabled'            => 'Selected suppliers enabled.',
        'global-disabled'           => 'Selected suppliers disabled.',
        'enabled'                   => 'Supplier enabled.',
        'disabled'                  => 'Supplier disabled.',
        'no-perm-selected'          => 'No supplier selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This supplier cannot be deleted',
        'cant-delete-perm-in-use'     => 'This supplier is in use or protected',
        'cant-edit-this-permission'   => 'This supplier cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Suppliers',
            'description'       => 'List of suppliers',
            'table-title'       => 'Supplier list',
        ],
        'show'              => [
            'title'             => 'Admin | Supplier | Show',
            'description'       => 'Displaying supplier: :name',
            'section-title'     => 'Supplier details'
        ],
        'create'            => [
            'title'            => 'Admin | Supplier | Create',
            'description'      => 'Creating a new supplier',
            'section-title'    => 'New supplier'
        ],
        'edit'              => [
            'title'            => 'Admin | Supplier | Edit',
            'description'      => 'Editing supplier: :name',
            'section-title'    => 'Edit supplier'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'category'                  =>  'Category',
        'contact'                   =>  'Contact',
        'address'                   =>  'Address',
        'description'               =>  'Description',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
    ],

    'action'               => [
        'create'                => 'Create new supplier',
        'generate'              => 'Generate suppliers',
    ],

];
