<?php

return [

    'audit-log'           => [
        'category'              => 'Materials',
        'msg-index'             => 'Accessed list of materials.',
        'msg-show'              => 'Accessed details of material: :name.',
        'msg-store'             => 'Created new material: :name.',
        'msg-edit'              => 'Initiated edit of material: :name.',
        'msg-update'            => 'Submitted edit of material: :name.',
        'msg-destroy'           => 'Deleted material: :name.',
        'msg-generate'          => 'Triggered generation of materials based on routes.',
        'msg-enable'            => 'Enabled material: :name.',
        'msg-disabled'          => 'Disabled material: :name.',
        'msg-enabled-selected'  => 'Enabled multiple materials.',
        'msg-disabled-selected' => 'Disabled multiple materials.',
    ],

    'status'              => [
        'created'                   => 'Material successfully created',
        'updated'                   => 'Material successfully updated',
        'deleted'                   => 'Material successfully deleted',
        'generated'                 => 'Successfully generated :number materials from routes.',
        'global-enabled'            => 'Selected materials enabled.',
        'global-disabled'           => 'Selected materials disabled.',
        'enabled'                   => 'Material enabled.',
        'disabled'                  => 'Material disabled.',
        'no-material-selected'      => 'No material selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This material cannot be deleted',
        'cant-delete-perm-in-use'     => 'This material is in use or protected',
        'cant-edit-this-permission'   => 'This material cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Materials',
            'description'       => 'List of materials',
            'table-title'       => 'Material list',
        ],
        'show'              => [
            'title'             => 'Admin | Material | Show',
            'description'       => 'Displaying material: :name',
            'section-title'     => 'Material details'
        ],
        'create'            => [
            'title'            => 'Admin | Material | Create',
            'description'      => 'Creating a new material',
            'section-title'    => 'New material'
        ],
        'edit'              => [
            'title'            => 'Admin | Material | Edit',
            'description'      => 'Editing material: :name',
            'section-title'    => 'Edit material'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'price'                     =>  'Price',
        'stock'                     =>  'Stock',
        'min_stock'                 =>  'Min Stock',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
    ],

    'action'               => [
        'create'                => 'Create new material',
        'generate'              => 'Generate materials',
    ],

];
