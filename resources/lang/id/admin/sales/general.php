<?php
return [

    'audit-log'           => [
        'category'              => 'Sales',
        'msg-index'             => 'Accessed list of sales.',
        'msg-show'              => 'Accessed details of sale: :name.',
        'msg-store'             => 'Created new sale: :name.',
        'msg-edit'              => 'Initiated edit of sale: :name.',
        'msg-replay-edit'       => 'Initiated replay edit of sale: :name.',
        'msg-update'            => 'Submitted edit of sale: :name.',
        'msg-destroy'           => 'Deleted sale: :name.',
        'msg-enable'            => 'Enabled sale: :name.',
        'msg-disabled'          => 'Disabled sale: :name.',
        'msg-enabled-selected'  => 'Enabled multiple sale.',
        'msg-disabled-selected' => 'Disabled multiple sale.',
    ],

    'status'              => [
        'created'                   => 'Penjualan berhasil dibuat.',
        'updated'                   => 'Penjualan berhasil diperbarui.',
        'deleted'                   => 'Penjualan berhasil dihapus.',
        'global-enabled'            => 'Selected sales enabled.',
        'global-disabled'           => 'Selected sales disabled.',
        'enabled'                   => 'Sale enabled.',
        'disabled'                  => 'Sale disabled.',
        'no-sale-selected'          => 'No sale selected.',
    ],

    'error'               => [
        'cant-be-edited'                => 'Sale cannot be edited',
        'cant-be-deleted'               => 'Sale cannot be deleted',
        'cant-be-disabled'              => 'Sale cannot be disabled',
        'login-failed-user-disabled'    => 'That account has been disabled.',
        'exp_not_found'                 => 'Could not find sale #:id.',
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Penjualan',
            'description'       => 'Daftar penjualan',
            'table-title'       => 'Daftar penjualan',
        ],
        'show'              => [
            'title'             => 'Admin | Penjualan | Tampilkan',
            'description'       => 'Menampilkan penjualan: :name',
            'section-title'     => 'Detail penjualan'
        ],
        'create'            => [
            'title'            => 'Admin | Penjualan | Tambah',
            'description'      => 'Tambah penjualan baru',
            'section-title'    => 'Tambah penjualan'
        ],
        'edit'              => [
            'title'            => 'Admin | Penjualan | Edit',
            'description'      => 'Edit penjualan: :name',
            'section-title'    => 'Edit penjualan'
        ],
        'report'            => [
            'title'            => 'Admin | Penjualan | Laporan',
            'description'      => 'Laporan penjualan',
            'section-title'    => 'Laporan'
        ],
        'formula'           => [
            'title'            => 'Admin | Penjualan | Formula',
            'description'      => 'Formula dari Penjualan: :name'
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'name'                      =>  'Nama',
        'order_date'                =>  'Tanggal Order',
        'transfer_date'             =>  'Tanggal Transfer',
        'ship_date'                 =>  'Tanggal Kirim',
        'estimation_date'           =>  'Tanggal Estimasi',
        'transfer_via'              =>  'Transfer Via',
        'status'                    =>  'Status',
        'discount'                  =>  'Diskon',
        'nominal'                   =>  'Nominal',
        'shipping_fee'              =>  'Ongkir',
        'packing_fee'               =>  'Biaya Packing',
        'expedition'                =>  'Ekspedisi',
        'resi'                      =>  'Resi',
        'description'               =>  'Keterangan',
        'total'                     =>  'Total',
        'created'                   =>  'Dibuat',
        'updated'                   =>  'Diupdate',
        'actions'                   =>  'Aksi',
        'effective'                 =>  'Efektif',
    ],

    'button'               => [
        'create'    =>  'Tambah penjualan baru',
    ],



];
