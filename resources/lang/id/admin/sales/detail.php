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
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Nama',
        'price'                     =>  'Harga',
        'quantity'                  =>  'Jumlah',
        'weight'                    =>  'Berat',
        'description'               =>  'Deskripsi',
        'total'                     =>  'Total',
        'created'                   =>  'Dibuat',
        'updated'                   =>  'Diperbarui',
        'actions'                   =>  'Aksi',
        'effective'                 =>  'Efektif',
    ],

    'button'               => [
        'create'    =>  'Create new sale',
    ],



];
