@extends('layouts.master')

@section('head_extra')
    <!-- Select2 css -->
    @include('partials._head_extra_select2_css')
    <!-- NProgress 0.2.0  -->
    <link rel="stylesheet" href="{{ asset('/bower_components/nprogress/nprogress.css') }}" media="screen" charset="utf-8">
@endsection

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('admin/customers/followup.page.index.table-title') }}</h3>
                  &nbsp;
                  {!! Form::select( 'customerType', config('constant.customer-types'), '', [ 'style' => 'max-width:150px;', 'id' => 'select-customer-type', 'class' => 'select-customer-type', '_token' => csrf_token()] ) !!}
                  &nbsp;
                  <a class="btn btn-default btn-sm" id="search" href="#" title="{{ trans('admin/customers/followup.button.search') }}">
                      <i class="fa fa-search"></i>
                  </a>

                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
              </div>
              <div class="box-body">
                  <div class="table-responsive">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th style="text-align: center">
                                      <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                          <i class="fa fa-check-square-o"></i>
                                      </a>
                                  </th>
                                  <th>{{ trans('admin/customers/general.columns.name') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.type') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.phone') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.address') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.actions') }}</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th style="text-align: center">
                                      <a class="btn" href="#" onclick="toggleCheckbox(); return false;" title="{{ trans('general.button.toggle-select') }}">
                                          <i class="fa fa-check-square-o"></i>
                                      </a>
                                  </th>
                                  <th>{{ trans('admin/customers/general.columns.name') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.type') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.phone') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.address') }}</th>
                                  <th>{{ trans('admin/customers/general.columns.actions') }}</th>
                              </tr>
                          </tfoot>
                          <tbody id="content">
                            @foreach($customerFollowups as $cf)
                              <tr>
                                  <td align="center">
                                    {!! Form::checkbox('chkUser[]', $cf->id); !!}
                                  </td>
                                  <td>{!! link_to_route('admin.customers.show', $cf->customer->name, $cf->customer->id) !!}</td>
                                  <td>{{ $cf->customer->getCustomerTypeDisplayName() }}</td>
                                  <td>{{ $cf->customer->phone }}</td>
                                  <td>{{ $cf->customer->address }}</td>
                                  <td>
                                    <a href="{!! route('admin.customer-followups.confirm-delete', $cf->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                      {!! $customerFollowups->render() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection

@section('body_bottom')
    <script language="JavaScript">
        function toggleCheckbox() {
            checkboxes = document.getElementsByName('chkUser[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = !checkboxes[i].checked;
            }
        }
    </script>

    <!-- Select2 4.0.0 -->
    <script src="{{ asset ("/bower_components/admin-lte/select2/js/select2.min.js") }}" type="text/javascript"></script>
    <!-- NProgress 0.2.0  -->
    <script src="{{ asset('/bower_components/nprogress/nprogress.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $(".select-customer-type").select2();

            $('#search').click(function(event) {
              event.preventDefault();
              NProgress.start();
              var query = $(".select-customer-type").val();
              var token = $(".select-customer-type").attr('_token');

              $.ajax({
                url : "customer-followups/select-by-type",
                data: ({query : query, _token : token}),
                type : 'POST',
                dataType : 'html',
                success: function(data){
                    console.log(query);
                    $( "#content" ).empty();
                    $( "#content" ).append( data );
                    NProgress.done();
                }
              });
              //window.open( SERVER +'penjualans/export/'+status+'/'+mulai+'/'+slesai);
            });
        });
    </script>
@endsection
