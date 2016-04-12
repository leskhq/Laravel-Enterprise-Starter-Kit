<?php
return [

    'audit-log'           => [
        'category'              => 'Expeditions',
        'msg-index'             => 'Accessed list of expeditions.',
        'msg-show'              => 'Accessed details of expedition: :name.',
        'msg-store'             => 'Created new expedition: :name.',
        'msg-edit'              => 'Initiated edit of expedition: :name.',
        'msg-replay-edit'       => 'Initiated replay edit of expedition: :name.',
        'msg-update'            => 'Submitted edit of expedition: :name.',
        'msg-destroy'           => 'Deleted expedition: :name.',
        'msg-enable'            => 'Enabled expedition: :name.',
        'msg-disabled'          => 'Disabled expedition: :name.',
        'msg-enabled-selected'  => 'Enabled multiple expedition.',
        'msg-disabled-selected' => 'Disabled multiple expedition.',
    ],

    'status'              => [
        'created'                   => 'Expedition successfully created',
        'updated'                   => 'Expedition successfully updated',
        'deleted'                   => 'Expedition successfully deleted',
        'global-enabled'            => 'Selected expedtions enabled.',
        'global-disabled'           => 'Selected expedtions disabled.',
        'enabled'                   => 'Expedition enabled.',
        'disabled'                  => 'Expedition disabled.',
        'no-exp-selected'           => 'No expedition selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Expedition cannot be edited',
        'cant-be-deleted'               => 'Expedition cannot be deleted',
        'cant-be-disabled'              => 'Expedition cannot be disabled',
        'login-failed-user-disabled'    => 'That account has been disabled.',
        'exp_not_found'                 => 'Could not find expedition #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Expeditions',
            'description'       => 'List of expeditions',
            'table-title'       => 'Expedition list',
        ],
        'show'              => [
            'title'             => 'Admin | Expedition | Show',
            'description'       => 'Displaying expedition: :name',
            'section-title'     => 'Expedition details'
        ],
        'create'            => [
            'title'            => 'Admin | Expedition | Create',
            'description'      => 'Creating a new expedition',
            'section-title'    => 'New expedition'
        ],
        'edit'              => [
            'title'            => 'Admin | Expedition | Edit',
            'description'      => 'Editing expedition: :name',
            'section-title'    => 'Edit expedition'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'contact'                   =>  'Contact',
        'description'               =>  'Description',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'effective'                 =>  'Effective',
    ],

    'button'               => [
        'create'    =>  'Create new expedition',
    ],



];
