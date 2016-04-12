<?php
return [

    'audit-log'           => [
        'category'              => 'Followup',
        'msg-index'             => 'Accessed list of followups.',
        'msg-show'              => 'Accessed details of followup: :name.',
        'msg-store'             => 'Created new followup: :name.',
        'msg-edit'              => 'Initiated edit of followup: :name.',
        'msg-replay-edit'       => 'Initiated replay edit of followup: :name.',
        'msg-update'            => 'Submitted edit of followup: :name.',
        'msg-destroy'           => 'Deleted followup: :name.',
        'msg-enable'            => 'Enabled followup: :name.',
        'msg-disabled'          => 'Disabled followup: :name.',
        'msg-enabled-selected'  => 'Enabled multiple followup.',
        'msg-disabled-selected' => 'Disabled multiple followup.',
    ],

    'status'              => [
        'created'                   => 'Followup successfully created',
        'updated'                   => 'Followup successfully updated',
        'deleted'                   => 'Followup successfully deleted',
        'global-enabled'            => 'Selected followups enabled.',
        'global-disabled'           => 'Selected followups disabled.',
        'enabled'                   => 'Followup enabled.',
        'disabled'                  => 'Followup disabled.',
        'no-followup-selected'      => 'No followup selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Followup cannot be edited',
        'cant-be-deleted'               => 'Followup cannot be deleted',
        'cant-be-disabled'              => 'Followup cannot be disabled',
        'followup_not_found'            => 'Could not find followup #:id.',
        'followup_not_found'            => 'Could not find followup #:id.',
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
