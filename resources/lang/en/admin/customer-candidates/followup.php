<?php
return [

    'audit-log'           => [
        'category'              => 'Users',
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
        'created'                   => 'Followup successfully created',
        'updated'                   => 'Followup successfully updated',
        'deleted'                   => 'Followup successfully deleted',
        'global-enabled'            => 'Selected users enabled.',
        'global-disabled'           => 'Selected users disabled.',
        'enabled'                   => 'Expedition enabled.',
        'disabled'                  => 'Expedition disabled.',
        'no-user-selected'          => 'No user selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Expedition cannot be edited',
        'cant-be-deleted'               => 'Expedition cannot be deleted',
        'cant-be-disabled'              => 'Expedition cannot be disabled',
        'login-failed-user-disabled'    => 'That account has been disabled.',
        'perm_not_found'                => 'Could not find permission #:id.',
        'user_not_found'                => 'Could not find user #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Followups',
            'description'       => 'List of followups',
            'table-title'       => 'Followup list',
        ],
        'show'              => [
            'title'             => 'Admin | Followup | Show',
            'description'       => 'Displaying followup: :name',
            'section-title'     => 'Followup details'
        ],
        'create'            => [
            'title'            => 'Admin | Followup | Create',
            'description'      => 'Creating a new followup',
            'section-title'    => 'New followup'
        ],
        'edit'              => [
            'title'            => 'Admin | Followup | Edit',
            'description'      => 'Editing followup: :name',
            'section-title'    => 'Edit followup'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'content'                   =>  'Content',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'effective'                 =>  'Effective',
    ],

    'button'               => [
        'create'    =>  'Create new followup',
        'search'    =>  'Search'
    ],



];

