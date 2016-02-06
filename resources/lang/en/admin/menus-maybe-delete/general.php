<?php

return [

    'audit-log'           => [
        'category'              => 'Menus',
        'msg-index'             => 'Accessed list of menus.',
        'msg-show'              => 'Accessed details of menu: :name.',
        'msg-store'             => 'Created new menu: :name.',
        'msg-edit'              => 'Initiated edit of menu: :name.',
        'msg-update'            => 'Submitted edit of menu: :name.',
        'msg-destroy'           => 'Deleted menu: :name.',
        'msg-enable'            => 'Enabled menu: :name.',
        'msg-disabled'          => 'Disabled menu: :name.',
        'msg-enabled-selected'  => 'Enabled multiple menus.',
        'msg-disabled-selected' => 'Disabled multiple menus.',
    ],

    'status'              => [
        'created'                   => 'Menu successfully created',
        'updated'                   => 'Menu successfully updated',
        'deleted'                   => 'Menu successfully deleted',
        'global-enabled'            => 'Selected menus enabled.',
        'global-disabled'           => 'Selected menus disabled.',
        'enabled'                   => 'Menu enabled.',
        'disabled'                  => 'Menu disabled.',
        'no-role-selected'          => 'No menu selected.',
    ],

    'error'               => [
        'cant-delete-this-menu' => 'This menu cannot be deleted',
        'cant-edit-this-menu'   => 'This menu cannot be edited',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Menus',
            'description'       => 'List of menus',
            'table-title'       => 'Menu list',
            'hierarchy'         => 'Hierarchy',
            'details'           => 'Details',
        ],
        'show'              => [
            'title'             => 'Admin | Menu | Show',
            'description'       => 'Displaying menu: :name',
            'section-title'     => 'Menu details'
        ],
        'create'            => [
            'title'            => 'Admin | Menu | Create',
            'description'      => 'Creating a new menu',
            'section-title'    => 'New menu'
        ],
        'edit'              => [
            'title'            => 'Admin | Menu | Edit',
            'description'      => 'Editing menu: :name',
            'section-title'    => 'Edit menu'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Name',
        'label'                     =>  'Label',
        'position'                  =>  'Position',
        'icon'                      =>  'Icon',
        'separator'                 =>  'Separator',
        'url'                       =>  'URL',
        'parent'                    =>  'Parent',
        'route'                     =>  'Route',
        'permission'                =>  'Permission',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'enabled'                   =>  'Enabled',
    ],

    'button'               => [
        'create'    =>  'Create new menu',
    ],

];
