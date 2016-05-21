<?php

return [

    'audit-log'           => [
        'category'              => 'Formulas',
        'msg-index'             => 'Accessed list of formulas.',
        'msg-show'              => 'Accessed details of formula: :name.',
        'msg-store'             => 'Created new formula: :name.',
        'msg-edit'              => 'Initiated edit of formula: :name.',
        'msg-update'            => 'Submitted edit of formula: :name.',
        'msg-destroy'           => 'Deleted formula: :name.',
        'msg-generate'          => 'Triggered generation of formulas based on routes.',
        'msg-enable'            => 'Enabled formula: :name.',
        'msg-disabled'          => 'Disabled formula: :name.',
        'msg-enabled-selected'  => 'Enabled multiple formulas.',
        'msg-disabled-selected' => 'Disabled multiple formulas.',
    ],

    'status'              => [
        'created'                   => 'Formula successfully created',
        'updated'                   => 'Formula successfully updated',
        'deleted'                   => 'Formula successfully deleted',
        'generated'                 => 'Successfully generated :number formulas from routes.',
        'global-enabled'            => 'Selected formulas enabled.',
        'global-disabled'           => 'Selected formulas disabled.',
        'enabled'                   => 'Formula enabled.',
        'disabled'                  => 'Formula disabled.',
        'no-formula-selected'       => 'No formula selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This formula cannot be deleted',
        'cant-delete-perm-in-use'     => 'This formula is in use or protected',
        'cant-edit-this-permission'   => 'This formula cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Formulas',
            'description'       => 'List of formulas',
            'table-title'       => 'Formula list',
        ],
        'show'              => [
            'title'             => 'Admin | Formula | Show',
            'description'       => 'Displaying formula: :name',
            'section-title'     => 'Formula details'
        ],
        'create'            => [
            'title'            => 'Admin | Formula | Create',
            'description'      => 'Creating a new formula',
            'section-title'    => 'New formula'
        ],
        'edit'              => [
            'title'            => 'Admin | Formula | Edit',
            'description'      => 'Editing formula: :name',
            'section-title'    => 'Edit formula'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'product_id'                =>  'Product',
        'materials'                 =>  'Materials',
        'created'                   =>  'Created',
        'quantity'                  =>  'Quantity',
        'total'                     =>  'Total',
        'need'                      =>  'Need',
        'stock'                     =>  'Stock',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
    ],

    'action'               => [
        'create'                => 'Create new formula',
        'generate'              => 'Generate formulas',
    ],

];
