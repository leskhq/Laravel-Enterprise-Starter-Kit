@extends('layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            {!! Form::open( array('route' => 'admin.audit.purge', 'id' => 'frmUserList') ) !!}
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('admin/audit/general.page.index.table-title') }}</h3>
                    &nbsp;
                    <a class="btn btn-default btn-sm" href="{!! route('admin.audit.purge') !!}" title="{{ trans('admin/audit/general.button.purge', ['purge_retention' => $purge_retention]) }}">
                        <i class="fa fa-eraser"></i>
                    </a>
                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin/audit/general.columns.username') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.category') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.message') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.date') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.actions') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ trans('admin/audit/general.columns.username') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.category') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.message') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.date') }}</th>
                                    <th>{{ trans('admin/audit/general.columns.actions') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($audits as $audit)
                                    <tr>
                                        <td>{{ ($audit->user) ? $audit->user->username : "N/A" }}</td>
                                        <td>{{ $audit->category }}</td>
                                        <td>{{ $audit->message }}</td>
                                        <td>@userTimeZone($audit->created_at)</td>
                                        <td>
                                            <a href="{!! route('admin.audit.show', $audit->id) !!}" title="{{ trans('general.button.display') }}"><i id="action-show" class="fa fa-eye"></i></a>
                                            @if ( $audit->replay_route )
                                                <a href="{!! route('admin.audit.replay', $audit->id) !!}" title="{{ trans('general.button.replay') }}"><i id="replay" class="fa fa-refresh spin-on-hover"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $audits->render() !!}
                    </div> <!-- table-responsive -->

                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')
    <!-- Add a spinner to the action replay icon while mouse is hovering. -->
    <script language="JavaScript">
        $('.spin-on-hover').hover(
                function () {
                    $(this).addClass('fa-spin');
                },
                function () {
                    $(this).removeClass('fa-spin');
                }
        );
    </script>
@endsection
