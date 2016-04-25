<?php
return [

    'audit-log'           => [
        'category'              => 'Customer Candidates',
        'msg-index'             => 'Accessed list of customer candidates.',
        'msg-show'              => 'Accessed details of customer candidate: :name.',
        'msg-store'             => 'Created new customer candidate: :name.',
        'msg-edit'              => 'Initiated edit of customer candidate: :name.',
        'msg-replay-edit'       => 'Initiated replay edit of customer candidate: :name.',
        'msg-update'            => 'Submitted edit of customer candidate: :name.',
        'msg-destroy'           => 'Deleted customer candidate: :name.',
        'msg-enable'            => 'Enabled customer candidate: :name.',
        'msg-disabled'          => 'Disabled customer candidate: :name.',
        'msg-enabled-selected'  => 'Enabled multiple customer candidate.',
        'msg-disabled-selected' => 'Disabled multiple customer candidate.',
    ],

    'status'              => [
        'created'                   => 'Customer Candidate successfully created',
        'updated'                   => 'Customer Candidate successfully updated',
        'deleted'                   => 'Customer Candidate successfully deleted',
        'global-enabled'            => 'Selected customer candidates enabled.',
        'global-disabled'           => 'Selected customer candidates disabled.',
        'enabled'                   => 'Customer Candidate enabled.',
        'disabled'                  => 'Customer Candidate disabled.',
        'no-candidate-selected'     => 'No customer candidate selected.',
        'changed'                   => 'This Candidate has now became Customer, Grats!',
    ],

    'error'               => [
        'cant-be-edited'                => 'Customer Candidate cannot be edited',
        'cant-be-deleted'               => 'Customer Candidate cannot be deleted',
        'cant-be-disabled'              => 'Customer Candidate cannot be disabled',
        'candidate_not_found'           => 'Could not find customer candidate #:id.',
        'candidate_not_found'           => 'Could not find customer candidate #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Customer Candidates',
            'description'       => 'List of customer candidates',
            'table-title'       => 'Customer Candidate list by months',
        ],
        'show'              => [
            'title'             => 'Admin | Customer Candidate | Show',
            'description'       => 'Displaying customer candidate: :name',
            'section-title'     => 'Customer Candidate details'
        ],
        'create'            => [
            'title'            => 'Admin | Customer Candidate | Create',
            'description'      => 'Creating a new customer candidate',
            'section-title'    => 'New customer candidate'
        ],
        'edit'              => [
            'title'            => 'Admin | Customer Candidate | Edit',
            'description'      => 'Editing customer candidate: :name',
            'section-title'    => 'Edit customer candidate'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'email'                     =>  'Email',
        'phone'                     =>  'Phone',
        'address'                   =>  'Address',
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
        'create'    =>  'Create new customer candidate',
    ],



];
