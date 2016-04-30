<?php

return [

    'audit-log'           => [
        'category'              => 'Sales',
        'msg-index'             => 'Accessed list of sales.',
        'msg-show'              => 'Accessed details of sale: :name.',
        'msg-store'             => 'Created new sale: :name.',
        'msg-edit'              => 'Initiated edit of sale: :name.',
        'msg-update'            => 'Submitted edit of sale: :name.',
        'msg-destroy'           => 'Deleted sale: :name.',
        'msg-generate'          => 'Triggered generation of sales based on routes.',
        'msg-enable'            => 'Enabled sale: :name.',
        'msg-disabled'          => 'Disabled sale: :name.',
        'msg-enabled-selected'  => 'Enabled multiple sales.',
        'msg-disabled-selected' => 'Disabled multiple sales.',
    ],

    'status'              => [
        'created'                   => 'Sale successfully created',
        'updated'                   => 'Sale successfully updated',
        'deleted'                   => 'Sale successfully deleted',
        'generated'                 => 'Successfully generated :number sales from routes.',
        'global-enabled'            => 'Selected sales enabled.',
        'global-disabled'           => 'Selected sales disabled.',
        'enabled'                   => 'Sale enabled.',
        'disabled'                  => 'Sale disabled.',
        'no-sale-selected'          => 'No sale selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This sale cannot be deleted',
        'cant-delete-perm-in-use'     => 'This sale is in use or protected',
        'cant-edit-this-permission'   => 'This sale cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Outlet | Sales',
            'description'       => 'List of sales',
            'table-title'       => 'Sale list',
        ],
        'show'              => [
            'title'             => 'Outlet | Sale | Show',
            'description'       => 'Displaying sale: :name',
            'section-title'     => 'Sale details'
        ],
        'create'            => [
            'title'            => 'Outlet | Sale | Create',
            'description'      => 'Creating a new sale',
            'section-title'    => 'New sale'
        ],
        'edit'              => [
            'title'            => 'Outlet | Sale | Edit',
            'description'      => 'Editing sale: :name',
            'section-title'    => 'Edit sale'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'kilo_quantity'             =>  'Kilo Quantity',
        'piece_quantity'            =>  'Piece Quantity',
        'kilo_total'                =>  'Kilo Total',
        'piece_total'               =>  'Piece Total',
        'description'               =>  'Description',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
    ],

    'action'               => [
        'create'                => 'Create new sale',
    ],

];
