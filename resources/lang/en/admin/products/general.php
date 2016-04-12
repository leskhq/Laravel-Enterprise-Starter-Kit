<?php
return [

    'audit-log'           => [
        'category'              => 'Products',
        'msg-index'             => 'Accessed list of products.',
        'msg-show'              => 'Accessed details of product: :name.',
        'msg-store'             => 'Created new product: :name.',
        'msg-edit'              => 'Initiated edit of product: :name.',
        'msg-replay-edit'       => 'Initiated replay edit of product: :name.',
        'msg-update'            => 'Submitted edit of product: :name.',
        'msg-destroy'           => 'Deleted product: :name.',
        'msg-enable'            => 'Enabled product: :name.',
        'msg-disabled'          => 'Disabled product: :name.',
        'msg-enabled-selected'  => 'Enabled multiple product.',
        'msg-disabled-selected' => 'Disabled multiple product.',
    ],

    'status'              => [
        'created'                   => 'Product successfully created',
        'updated'                   => 'Product successfully updated',
        'deleted'                   => 'Product successfully deleted',
        'global-enabled'            => 'Selected products enabled.',
        'global-disabled'           => 'Selected products disabled.',
        'enabled'                   => 'Product enabled.',
        'disabled'                  => 'Product disabled.',
        'no-product-selected'       => 'No product selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Product cannot be edited',
        'cant-be-deleted'               => 'Product cannot be deleted',
        'cant-be-disabled'              => 'Product cannot be disabled',
        'login-failed-user-disabled'    => 'That account has been disabled.',
        'product_not_found'             => 'Could not find product #:id.',
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
