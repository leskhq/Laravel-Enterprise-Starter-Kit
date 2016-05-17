@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Materials</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example2" class="table no-margin">
                    <thead>
                        <tr>
                            <th>Material Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formula->formulaDetails as $d)
                        <tr>
                            <td><a href="#">{{ $d->material->name }}</a></td>
                            <td>{{ $d->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{ route('admin.formulas.edit', $formula->id) }}" class="btn btn-sm btn-info btn-flat pull-left">
                <i class="fa fa-edit"></i> {{ trans('general.button.edit') }}
            </a>
            <a href="{{ route('admin.formulas.index') }}" class="btn btn-sm btn-default btn-flat pull-right">
                <i class="fa fa-times"></i> {{ trans('general.button.close') }}
            </a>
        </div>
        <!-- /.box-footer -->
    </div>
@endsection

@section('body_bottom')
@endsection