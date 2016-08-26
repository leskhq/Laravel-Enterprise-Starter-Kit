@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.errors.purge', 'id' => 'frmUserList') ) !!}
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/error/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.errors.purge') !!}" title="{{ trans('admin/error/general.button.purge', ['purge_retention' => $purge_retention]) }}">
                        <i class="fa fa-eraser"></i>
                    </a>
                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/error/general.columns.date') }}</th>
                                    <th>{{ trans('admin/error/general.columns.class') }}</th>
                                    <th>{{ trans('admin/error/general.columns.url') }}</th>
                                    <th>{{ trans('admin/error/general.columns.message') }}</th>
                                    <th>{{ trans('admin/error/general.columns.user') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/error/general.columns.date') }}</th>
                                    <th>{{ trans('admin/error/general.columns.class') }}</th>
                                    <th>{{ trans('admin/error/general.columns.url') }}</th>
                                    <th>{{ trans('admin/error/general.columns.message') }}</th>
                                    <th>{{ trans('admin/error/general.columns.user') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($lern_errors as $lern_error)

                                        <tr>
                                            <td><nobr><a href="{!! route('admin.errors.show', $lern_error->id) !!}" title="{{ trans('general.button.display') }}">@userTimeZone($lern_error->created_at)</a></nobr></td>
                                            <td><a href="{!! route('admin.errors.show', $lern_error->id) !!}" title="{{ trans('general.button.display') }}">@strHeadAndTail($lern_error->class, 50, "...")</a></td>
                                            <td><a href="{!! route('admin.errors.show', $lern_error->id) !!}" title="{{ trans('general.button.display') }}">@strTail($lern_error->url, 30, "...")</a></td>
                                            <td><a href="{!! route('admin.errors.show', $lern_error->id) !!}" title="{{ trans('general.button.display') }}">@strHead($lern_error->message, 70, "...")</a></td>
                                            <td>
                                                @if ($lern_error->user)
                                                    <a href="{!! route('admin.users.show', $lern_error->user->id) !!}" title="{{ trans('general.button.display') }}"> {{ $lern_error->user->username }} </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    </a>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $lern_errors->render() !!}
                    </div> <!-- table-responsive -->

                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
@endsection
