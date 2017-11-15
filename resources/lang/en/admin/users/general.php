<?php
return [

    'audit-log'           => [
        'category'              => 'Users',
        'msg-index'             => 'Accessed list of Users.',
        'msg-show'              => 'Accessed details of User.',
        'msg-create'            => 'Initiated creation of new Users.',
        'msg-store'             => 'Created new User.',
        'msg-edit'              => 'Initiated edit of User.',
        'msg-update'            => 'Submitted edit of User.',
        'msg-get-modal-delete'  => 'Request delete User confirmation.',
        'msg-destroy'           => 'Deleted User.',
        'msg-enable'            => 'Enabled User.',
        'msg-disabled'          => 'Disabled User.',
        'msg-enabled-selected'  => 'Enabled multiple selected User.',
        'msg-disabled-selected' => 'Disabled multiple selected User.',
    ],

    'status'              => [
        'created'                   => 'User successfully created',
        'updated'                   => 'User successfully updated',
        'deleted'                   => 'User successfully deleted',
        'global-enabled'            => 'Selected users enabled.',
        'global-disabled'           => 'Selected users disabled.',
        'enabled'                   => 'User enabled.',
        'disabled'                  => 'User disabled.',
        'no-user-selected'          => 'No user selected.',
        'user-update-failed'        => 'User update failed due to: :failure.'
    ],

    'error'               => [
        'cant-be-edited'                 => 'User cannot be edited.',
        'cant-be-deleted'                => 'User cannot be deleted.',
        'cant-delete-yourself'           => 'Cannot delete your own account.',
        'cant-be-disabled'               => 'User cannot be disabled.',
        'login-failed-user-disabled'     => 'That account has been disabled.',
        'perm_not_found'                 => 'Could not find permission #:id.',
        'user_not_found'                 => 'Could not find user #:id.',
        'no-permission-to-create-users'  => 'You do not have the permission to create new users.',
        'no-permission-to-enable-users'  => 'You do not have the permission to enable users.',
        'no-permission-to-disable-users' => 'You do not have the permission to disable users.',
        'no-permission-to-update-users'  => 'You do not have the permission to edit users.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Users',
            'description'       => 'List of users',
            'table-title'       => '',
        ],
        'show'              => [
            'title'             => 'Admin | User | Show',
            'description'       => 'Displaying user: :full_name',
            'section-title'     => 'User details'
        ],
        'create'            => [
            'title'            => 'Admin | User | Create',
            'description'      => 'Creating a new user',
            'section-title'    => 'New user'
        ],
        'edit'              => [
            'title'            => 'Admin | User | Edit',
            'description'      => 'Editing user: :full_name',
            'section-title'    => 'Edit user'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'gravatar'                  =>  'Gravatar',
        'username'                  =>  'User name',
        'first_name'                =>  'First name',
        'last_name'                 =>  'Last name',
        'name'                      =>  'Name',
        'assigned'                  =>  'Assigned',
        'roles'                     =>  'Roles',
        'roles-not-found'           =>  'Roles not found',
        'email'                     =>  'Email',
        'type'                      =>  'Type',
        'auth_type'                 =>  'Type',
        'permissions'               =>  'Permissions',
        'permissions-not-found'     =>  'Permissions not found',
        'password'                  =>  'Password',
        'password_confirmation'     =>  'Password confirmation',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'effective'                 =>  'Effective',
        'enabled'                   =>  'Enabled',
        'theme'                     =>  'Theme',
        'time_zone'                 =>  'Time zone',
        'timezone'                  =>  'Time zone',
        'locale'                    =>  'Locale',
        'time_format'               =>  'Time format',
        'description'               =>  'Description',
    ],

    'button'               => [
        'create'    =>  'Create new user',
    ],

    'options'               => [
        '12_hours'    =>  '12 hours',
        '24_hours'    =>  '24 hours',
    ],

    'placeholder'           => [
        'select-theme'         => 'Select a theme',
        'select-time_zone'     => 'Select a time-zone',
        'select-locale'        => 'Select a locale',
    ],



];

