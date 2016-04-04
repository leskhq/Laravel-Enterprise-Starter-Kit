<?php
return [

    'audit-log'           => [
        'category'              => 'Products',
        'msg-index'             => 'Accessed list of users.',
        'msg-show'              => 'Accessed details of user: :username.',
        'msg-store'             => 'Created new user: :username.',
        'msg-edit'              => 'Initiated edit of user: :username.',
        'msg-replay-edit'       => 'Initiated replay edit of user: :username.',
        'msg-update'            => 'Submitted edit of user: :username.',
        'msg-destroy'           => 'Deleted user: :username.',
        'msg-enable'            => 'Enabled user: :username.',
        'msg-disabled'          => 'Disabled user: :username.',
        'msg-enabled-selected'  => 'Enabled multiple user.',
        'msg-disabled-selected' => 'Disabled multiple user.',
    ],

    'status'              => [
        'created'                   => 'Product successfully created',
        'updated'                   => 'Product successfully updated',
        'deleted'                   => 'Product successfully deleted',
        'global-enabled'            => 'Selected products enabled.',
        'global-disabled'           => 'Selected products disabled.',
        'enabled'                   => 'Product enabled.',
        'disabled'                  => 'Product disabled.',
        'no-user-selected'          => 'No product selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'User cannot be edited',
        'cant-be-deleted'               => 'User cannot be deleted',
        'cant-be-disabled'              => 'User cannot be disabled',
        'login-failed-user-disabled'    => 'That account has been disabled.',
        'perm_not_found'                => 'Could not find permission #:id.',
        'user_not_found'                => 'Could not find user #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Products',
            'description'       => 'List of products',
            'table-title'       => 'Product list',
            'categories'        => 'Categories',
            'price-list'        => 'Price List'
        ],
        'show'              => [
            'title'             => 'Admin | Product | Show',
            'description'       => 'Displaying product: :full_name',
            'section-title'     => 'Product details',
        ],
        'create'            => [
            'title'            => 'Admin | Product | Create',
            'description'      => 'Creating a new product',
            'section-title'    => 'New product'
        ],
        'edit'              => [
            'title'            => 'Admin | Product | Edit',
            'description'      => 'Editing product: :full_name',
            'section-title'    => 'Edit product'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Product name',
        'category'                  =>  'Category Product',
        'hpp'                       =>  'HPP',
        'price'                     =>  'Price',
        'agenresmi_price'           =>  'Agen Resmi Price',
        'agenlepas_price'           =>  'Agen Lepas Price',
        'distributor_price'         =>  'Distributor Price',
        'weight'                    =>  'Weight',
        'stock'                     =>  'Stock',
        'image'                     =>  'Image',
        'published'                 =>  'Status',
        'perfume_id'                =>  'Perfume',
        'supplier_id'               =>  'Supplier',
        'description'               =>  'Description',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'effective'                 =>  'Effective',
        'enabled'                   =>  'Enabled',
    ],

    'button'               => [
        'create'    =>  'Create new product',
    ],



];

