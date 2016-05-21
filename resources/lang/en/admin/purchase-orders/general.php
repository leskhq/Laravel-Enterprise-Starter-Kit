<?php

return [

    'audit-log'           => [
        'category'              => 'Purchase Orders',
        'msg-index'             => 'Accessed list of purchase orders.',
        'msg-show'              => 'Accessed details of purchase order: :name.',
        'msg-store'             => 'Created new purchase order: :name.',
        'msg-edit'              => 'Initiated edit of purchase order: :name.',
        'msg-update'            => 'Submitted edit of purchase order: :name.',
        'msg-destroy'           => 'Deleted purchase order: :name.',
        'msg-generate'          => 'Triggered generation of purchase orders based on routes.',
        'msg-enable'            => 'Enabled purchase order: :name.',
        'msg-disabled'          => 'Disabled purchase order: :name.',
        'msg-enabled-selected'  => 'Enabled multiple purchase orders.',
        'msg-disabled-selected' => 'Disabled multiple purchase orders.',
    ],

    'status'              => [
        'created'                   => 'Purchase Order successfully created',
        'updated'                   => 'Purchase Order successfully updated',
        'deleted'                   => 'Purchase Order successfully deleted',
        'generated'                 => 'Successfully generated :number purchase orders from routes.',
        'global-enabled'            => 'Selected purchase orders enabled.',
        'global-disabled'           => 'Selected purchase orders disabled.',
        'enabled'                   => 'Purchase Order enabled.',
        'disabled'                  => 'Purchase Order disabled.',
        'no-purchase order-selected'       => 'No purchase order selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This purchase order cannot be deleted',
        'cant-delete-perm-in-use'     => 'This purchase order is in use or protected',
        'cant-edit-this-permission'   => 'This purchase order cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Purchase Orders',
            'description'       => 'List of purchase orders',
            'table-title'       => 'Purchase Order list',
        ],
        'show'              => [
            'title'             => 'Admin | Purchase Order | Show',
            'description'       => 'Displaying purchase order: :name',
            'section-title'     => 'Purchase Order details'
        ],
        'create'            => [
            'title'            => 'Admin | Purchase Order | Create',
            'description'      => 'Creating a new purchase order',
            'section-title'    => 'New purchase order'
        ],
        'edit'              => [
            'title'            => 'Admin | Purchase Order | Edit',
            'description'      => 'Editing purchase order: :name',
            'section-title'    => 'Edit purchase order'
        ],
    ],

    'columns'           => [
        'id'          =>  'ID',
        'status'      =>  'Status',
        'supplier'    =>  'Supplier',
        'description' =>  'Description',
        'total'       =>  'Total',
        'created'     =>  'Created',
        'updated'     =>  'Updated',
        'actions'     =>  'Actions',
    ],

    'detail' => [
        'columns' => [
            'material'    => 'Material',
            'price'       => 'Price',
            'quantity'    => 'Quantity',
            'description' => 'Description',
            'total'       => 'Total',
            'accepted'    => 'Accepted'
        ]
    ],

    'action'               => [
        'create'                => 'Create new purchase order',
        'generate'              => 'Generate purchase orders',
    ],

];
