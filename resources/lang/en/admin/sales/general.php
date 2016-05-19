<?php
return [

    'audit-log'           => [
        'category'              => 'Sales',
        'msg-index'             => 'Accessed list of sales.',
        'msg-show'              => 'Accessed details of sale: :name.',
        'msg-store'             => 'Created new sale: :name.',
        'msg-edit'              => 'Initiated edit of sale: :name.',
        'msg-replay-edit'       => 'Initiated replay edit of sale: :name.',
        'msg-update'            => 'Submitted edit of sale: :name.',
        'msg-destroy'           => 'Deleted sale: :name.',
        'msg-enable'            => 'Enabled sale: :name.',
        'msg-disabled'          => 'Disabled sale: :name.',
        'msg-enabled-selected'  => 'Enabled multiple sale.',
        'msg-disabled-selected' => 'Disabled multiple sale.',
    ],

    'status'              => [
        'created'                   => 'Sale successfully created',
        'updated'                   => 'Sale successfully updated',
        'deleted'                   => 'Sale successfully deleted',
        'global-enabled'            => 'Selected sales enabled.',
        'global-disabled'           => 'Selected sales disabled.',
        'enabled'                   => 'Sale enabled.',
        'disabled'                  => 'Sale disabled.',
        'no-sale-selected'          => 'No sale selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Sale cannot be edited',
        'cant-be-deleted'               => 'Sale cannot be deleted',
        'cant-be-disabled'              => 'Sale cannot be disabled',
        'login-failed-user-disabled'    => 'That account has been disabled.',
        'exp_not_found'                 => 'Could not find sale #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Sales',
            'description'       => 'List of sales',
            'table-title'       => 'Sale list',
        ],
        'show'              => [
            'title'             => 'Admin | Sale | Show',
            'description'       => 'Displaying sale: :name',
            'section-title'     => 'Sale details'
        ],
        'create'            => [
            'title'            => 'Admin | Sale | Create',
            'description'      => 'Creating a new sale',
            'section-title'    => 'New sale'
        ],
        'edit'              => [
            'title'            => 'Admin | Sale | Edit',
            'description'      => 'Editing sale: :name',
            'section-title'    => 'Edit sale'
        ],
        'report'              => [
            'title'            => 'Admin | Sales | Report',
            'description'      => 'All sales report',
            'section-title'    => 'Report'
        ],
        'formula'             => [
            'title'             => 'Admin | Sales | Formula',
            'description'       => 'Formula from Sale: :name'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'order_date'                =>  'Order Date',
        'transfer_date'             =>  'Transfer Date',
        'ship_date'                 =>  'Ship Date',
        'estimation_date'           =>  'Estimation Date',
        'transfer_via'              =>  'Transfer Via',
        'status'                    =>  'Status',
        'discount'                  =>  'Discount',
        'nominal'                   =>  'Nominal',
        'shipping_fee'              =>  'Shipping Fee',
        'packing_fee'               =>  'Packing Fee',
        'expedition'                =>  'Expedition',
        'resi'                      =>  'Resi',
        'description'               =>  'Description',
        'total'                     =>  'Total',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'effective'                 =>  'Effective',
    ],

    'button'               => [
        'create'    =>  'Create new sale',
    ],



];
