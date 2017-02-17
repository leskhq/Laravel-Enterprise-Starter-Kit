@extends('layouts.master')

@section('content')

	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                	<h3 class="box-title">Order Dari Store</h3>
                </div>
                <div class="box-body">
                	<div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                        	<thead>
                        		<tr>
                        			<th>Nama</th>
                        			<th>Total</th>
                        			<th>Status</th>
                        			<th>Dibuat</th>
                        			<th>Aksi</th>
                        		</tr>
                        	</thead>
                        	<tfoot>
                        		<tr>
                        			<th>Nama</th>
                        			<th>Total</th>
                        			<th>Status</th>
                        			<th>Dibuat</th>
                        			<th>Aksi</th>
                        		</tr>
                        	</tfoot>
                        	<tbody id="content">
                        		@foreach($orders as $value)
                        		<tr>
                        			<td>{{ $value->storeCustomer->name() }}</td>
                        			<td>{{ Helpers::reggo($value->total) }}</td>
                        			<td>{{ $value->status }}</td>
                        			<td>{{ date('l, d F Y', strtotime($value->created_at)) }}</td>
                        			<td></td>
                        		</tr>
                        		@endforeach
                        	</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection