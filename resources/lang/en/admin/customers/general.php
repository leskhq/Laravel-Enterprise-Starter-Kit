<?php
return [

    'audit-log'           => [
        'category'              => 'Customers',
        'msg-index'             => 'Accessed list of customers.',
        'msg-show'              => 'Accessed details of customer: :username.',
        'msg-store'             => 'Created new customer: :username.',
        'msg-edit'              => 'Initiated edit of customer: :username.',
        'msg-replay-edit'       => 'Initiated replay edit of customer: :username.',
        'msg-update'            => 'Submitted edit of customer: :username.',
        'msg-destroy'           => 'Deleted customer: :username.',
        'msg-enable'            => 'Enabled customer: :username.',
        'msg-disabled'          => 'Disabled customer: :username.',
        'msg-enabled-selected'  => 'Enabled multiple customer.',
        'msg-disabled-selected' => 'Disabled multiple customer.',
    ],

    'status'              => [
        'created'                   => 'Customer successfully created',
        'updated'                   => 'Customer successfully updated',
        'deleted'                   => 'Customer successfully deleted',
        'global-enabled'            => 'Selected customers enabled.',
        'global-disabled'           => 'Selected customers disabled.',
        'enabled'                   => 'Customer enabled.',
        'disabled'                  => 'Customer disabled.',
        'no-customer-selected'      => 'No customer selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Customer cannot be edited',
        'cant-be-deleted'               => 'Customer cannot be deleted',
        'cant-be-disabled'              => 'Customer cannot be disabled',
        'perm_not_found'                => 'Could not find permission #:id.',
        'user_not_found'                => 'Could not find customer #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Customer',
            'description'       => 'List of customer type: :type',
            'table-title'       => 'Customer list',
        ],
        'show'              => [
            'title'             => 'Admin | Customer | Show',
            'description'       => 'Displaying customer: :name',
            'section-title'     => 'Customer details'
        ],
        'create'            => [
            'title'            => 'Admin | Customer | Create',
            'description'      => 'Creating a new customer',
            'section-title'    => 'New customer'
        ],
        'edit'              => [
            'title'            => 'Admin | Customer | Edit',
            'description'      => 'Editing customer: :name',
            'section-title'    => 'Edit customer'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'email'                     =>  'Email',
        'phone'                     =>  'Phone',
        'address'                   =>  'Address',
        'send_address'              =>  'Send Address',
        'outlet_address'            =>  'Outlet Address',
        'laundry_name'              =>  'Laundry Name',
        'laundry_address'           =>  'Laundry Address',
        'type'                      =>  'Type',
        'status'                    =>  'Active',
        'contact'                   =>  'Contact',
        'description'               =>  'Description',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'effective'                 =>  'Effective',
    ],

    'button'               => [
        'create'    =>  'Create new customer',
    ],



];
