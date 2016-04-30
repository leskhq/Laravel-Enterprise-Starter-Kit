<?php

return [

    'audit-log'           => [
        'category'              => 'Customers',
        'msg-index'             => 'Accessed list of customers.',
        'msg-show'              => 'Accessed details of customer: :name.',
        'msg-store'             => 'Created new customer: :name.',
        'msg-edit'              => 'Initiated edit of customer: :name.',
        'msg-update'            => 'Submitted edit of customer: :name.',
        'msg-destroy'           => 'Deleted customer: :name.',
        'msg-generate'          => 'Triggered generation of customers based on routes.',
        'msg-enable'            => 'Enabled customer: :name.',
        'msg-disabled'          => 'Disabled customer: :name.',
        'msg-enabled-selected'  => 'Enabled multiple customers.',
        'msg-disabled-selected' => 'Disabled multiple customers.',
    ],

    'status'              => [
        'created'                   => 'Customer successfully created',
        'updated'                   => 'Customer successfully updated',
        'deleted'                   => 'Customer successfully deleted',
        'generated'                 => 'Successfully generated :number customers from routes.',
        'global-enabled'            => 'Selected customers enabled.',
        'global-disabled'           => 'Selected customers disabled.',
        'enabled'                   => 'Customer enabled.',
        'disabled'                  => 'Customer disabled.',
        'no-customer-selected'      => 'No customer selected.',
    ],

    'error'               => [
        'cant-delete-this-permission' => 'This customer cannot be deleted',
        'cant-delete-perm-in-use'     => 'This customer is in use or protected',
        'cant-edit-this-permission'   => 'This customer cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Outlet | Customer',
            'description'       => 'List of customers',
            'table-title'       => 'Customer list',
        ],
        'show'              => [
            'title'             => 'Outlet | Customer | Show',
            'description'       => 'Displaying customer: :name',
            'section-title'     => 'Customer details'
        ],
        'create'            => [
            'title'            => 'Outlet | Customer | Create',
            'description'      => 'Creating a new customer',
            'section-title'    => 'New customer'
        ],
        'edit'              => [
            'title'            => 'Outlet | Customer | Edit',
            'description'      => 'Editing customer: :name',
            'section-title'    => 'Edit customer'
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
        'create'                => 'Create new customer',
    ],

];
