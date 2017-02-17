@extends('layouts.master')

@section('head_extra')
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.min.css">
    <!-- NProgress 0.2.0  -->
    <link rel="stylesheet" href="{{ asset('/bower_components/nprogress/nprogress.css') }}" media="screen" charset="utf-8">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header pull-left">
                    <form action="#" class="form-inline">
                        <input id="token" type="hidden" value="{{ csrf_token() }}">
                        {!! Form::text('start', '', ['class' => 'date form-control', 'placeholder' => 'Starting Date', 'id' => 'start']) !!}
                        {!! Form::text('end', '', ['class' => 'date form-control', 'placeholder' => 'End Date', 'id' => 'end']) !!}
                        <button class="btn btn-primary" id="go">GO</button>
                        <button class="btn btn-primary" id="go2">By Ship Date</button>
                    </form>
                </div>
                <div class="box-header pull-right">
                    <form action="{{ route('admin.sales.export') }}" method="post" class="form-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {!! Form::hidden('eStart', '', ['id' => 'eStart']) !!}
                        {!! Form::hidden('eEnd', '', ['id' => 'eEnd']) !!}
                        <button class="btn btn-success" id="export">Export</button>
                    </form>
                </div>
                <div class="box-body">
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>No PO</th>
                                <th>Customer</th>
				<th>Tipe Customer</th>
                                <th>Tanggal Order</th>
                                <th>Tanggal Transfer</th>
                                <th>Status</th>
                                <th>Chemical</th>
                                <th>Bahan Baku</th>
                                <th>Perlengkapan</th>
                                <th>Ongkir</th>
				<th>Packing</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody id='isi'>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

    <!-- NProgress 0.2.0  -->
    <script src="{{ asset('/bower_components/nprogress/nprogress.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $('.date').datepicker({
            format            : "yyyy-mm-dd",
            todayBtn          : "linked",
            keyboardNavigation: false,
            forceParse        : false,
            calendarWeeks     : false,
            autoclose         : true
        });

        $('#go').click(function(event) {
            NProgress.start();
            event.preventDefault();
            var start   = $("#start").val();
            var end     = $("#end").val();
            var token   = $("#token").val();
            $.ajax({
                url      : "/admin/sales/getReportData",
                data     : ({start : start, end : end, _token : token}),
                type     : 'POST',
                dataType : 'html',
                success: function(data){
                    NProgress.done();
                    $('#eStart').empty();
                    $('#eEnd').empty();
                    $('#eStart').val(start);
                    $('#eEnd').val(end);
                    $( "#isi" ).empty();
                    $( "#isi" ).append( data );
                }
            });
        });
        $('#go2').click(function(event) {
            NProgress.start();
            event.preventDefault();
            var start   = $("#start").val();
            var end     = $("#end").val();
            var token   = $("#token").val();
            $.ajax({
                url      : "/admin/sales/getReportDataByShipDate",
                data     : ({start : start, end : end, _token : token}),
                type     : 'POST',
                dataType : 'html',
                success: function(data){
                    NProgress.done();
                    $('#eStart').empty();
                    $('#eEnd').empty();
                    $('#eStart').val(start);
                    $('#eEnd').val(end);
                    $( "#isi" ).empty();
                    $( "#isi" ).append( data );
                }
            });
        });
    </script>
@endsection
