<?php
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

return array(
    'save'    => 'Save',
    'delete'  => 'Delete',
    'clear'   => 'Clear',
    'cancel'  => 'Cancel',
    'ok'      => 'OK',

    'modal-delete-title'   => 'Delete menu',
    'modal-delete-message' => 'Are you sure that you want to delete menu ID :id with the label :label? This operation is irreversible.',

    'modal-delete-title-cant-be-deleted'   => 'Error Deleting',
    'modal-delete-message-cant-be-deleted' => 'You cannot delete menu ID :id with the label :label!',

    'enabled'   => 'Enabled',
    'url'       => 'URL',
    'separator' => 'Separator',
    'icon'      => 'Icon',
    'position'  => 'Position',
    'parent'    => 'Parent',
    'label'     => 'Label',
    'name'      => 'Name',
    'details'   => 'Details',
    'hierarchy' => 'Hierarchy',

    'menu-builder-admin-title'         => 'Menu Builder Admin',
    'menu-builder-admin-description'   => 'Here you can build your menu. Click on an existing menu entry to
                                           edit it, and click the <i>Save</i> button to save any changes. <br/>
                                           Click on the <i>Clear</i> button to create a new entry.',

    'update-success'  =>  'Menu successfully updated',
    'create-success'  =>  'Menu successfully created',
    'delete-success'  =>  'Menu successfully deleted',

    'delete-failed-cant-be-deleted'  =>  'You cannot delete menu ID :id with the label :label!',
    'update-failed-cant-be-edited'   =>  'You cannot edit menu ID :id with the label :label!',

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


);
