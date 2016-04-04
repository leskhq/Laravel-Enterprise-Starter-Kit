@extends('layouts.master')

@section('head_extra')
    <!-- autocomplete ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')

  <div class="row">
    <div class="col-md-3">
      {!! link_to('admin/products/create', trans('admin/products/general.button.create'), ['class' => 'btn btn-primary btn-block margin-bottom']); !!}
      <div class="box box-solid">
          <div class="box-header with-border">
              <h3 class="box-title">{{ trans('admin/products/general.page.index.categories') }}</h3>
              <div class="box-tools">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
          <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                  <li class="{{ ($id == 1) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/1') }}">
                          <i class="fa fa-inbox"></i>Detergent & Pewangi
                          <!-- <span class="label label-primary pull-right">12</span> -->
                      </a>
                  </li>
                  <li class="{{ ($id == 2) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/2') }}"><i class="fa fa-sun-o"></i>Anti Noda & Spotter</a>
                  </li>
                  <li class="{{ ($id == 3) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/3') }}"><i class="fa fa-cart-plus"></i>Produk Rumah Tangga</a>
                  </li>
                  <li class="{{ ($id == 4) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/4') }}">
                          <i class="fa fa-filter"></i>Produk Otomotif
                          <span class="label label-warning pull-right">65</span>
                      </a>
                  </li>
                  <li class="{{ ($id == 5) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/5') }}"><i class="fa fa-industry"></i>Perlengkapan</a>
                  </li>
                  <li class="{{ ($id == 6) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/6') }}"><i class="fa fa-apple"></i>Bibit Parfum</a>
                  </li>
                  <li class="{{ ($id == 7) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/7') }}"><i class="fa fa-leaf"></i>Bahan Baku</a>
                  </li>
                  <li class="{{ ($id == 8) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/products/cat/8') }}"><i class="fa fa-fire-extinguisher"></i>Parfum</a>
                  </li>
                  <li class="{{ ($id == 7) ? 'active' : '' }}">
                      <a href="{{ URL::to('admin/bahan') }}"><i class="fa fa-leaf"></i>Bahan Baku Gudang</a>
                  </li>
              </ul>
          </div><!-- /.box-body -->
      </div><!-- /. box -->
      <div class="box box-solid">
          <div class="box-header with-border">
              <h3 class="box-title">{{ trans('admin/products/general.page.index.price-list') }}</h3>
              <div class="box-tools">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
          <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="{{url('admin/priceList/1')}}"><i class="fa fa-circle-o text-red"></i> Price List Agen Resmi</a></li>
                  <li><a href="{{url('admin/priceList/2')}}"><i class="fa fa-circle-o text-yellow"></i> Price List Agen Lepas</a></li>
                  <li><a href="{{url('admin/priceList/3')}}"><i class="fa fa-circle-o text-light-blue"></i> Price List Customer</a></li>
              </ul>
          </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-9">
      <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">{{ trans('admin/products/general.page.index.table-title') }}</h3>
              <div class="box-tools pull-right">
                  <div class="has-feedback">
                      <input name="keyword" type="text" id="search" class="form-control input-sm" placeholder="Cari Produk">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                  </div>
              </div><!-- /.box-tools -->
          </div><!-- /.box-header -->

          <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                      <thead>
                          <th>
                            @if($sortBy == 'name' && $orderBy == 'asc')
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.name'),
                                ['id' => $id, 'sortBy' => 'name', 'orderBy' => 'desc']
                                ) !!}
                            @else
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.name'),
                                ['id' => $id, 'sortBy' => 'name', 'orderBy' => 'asc']
                                ) !!}
                            @endif
                          </th>
                          <th>
                            @if($sortBy == 'hpp' && $orderBy == 'asc')
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.hpp'),
                                ['id' => $id, 'sortBy' => 'hpp', 'orderBy' => 'desc']
                                ) !!}
                            @else
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.hpp'),
                                ['id' => $id, 'sortBy' => 'hpp', 'orderBy' => 'asc']
                                ) !!}
                            @endif
                          </th>
                          <th>
                            @if($sortBy == 'agenresmi_price' && $orderBy == 'asc')
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.agenresmi_price'),
                                ['id' => $id, 'sortBy' => 'agenresmi_price', 'orderBy' => 'desc']
                                ) !!}
                            @else
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.agenresmi_price'),
                                ['id' => $id, 'sortBy' => 'agenresmi_price', 'orderBy' => 'asc']
                                ) !!}
                            @endif
                          </th>
                          <th>
                            @if($sortBy == 'agenlepas_price' && $orderBy == 'asc')
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.agenlepas_price'),
                                ['id' => $id, 'sortBy' => 'agenlepas_price', 'orderBy' => 'desc']
                                ) !!}
                            @else
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.agenlepas_price'),
                                ['id' => $id, 'sortBy' => 'agenlepas_price', 'orderBy' => 'asc']
                                ) !!}
                            @endif
                          </th>
                          <th>
                            @if($sortBy == 'price' && $orderBy == 'asc')
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.price'),
                                ['id' => $id, 'sortBy' => 'price', 'orderBy' => 'desc']
                                ) !!}
                            @else
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.price'),
                                ['id' => $id, 'sortBy' => 'price', 'orderBy' => 'asc']
                                ) !!}
                            @endif
                          </th>
                          <th>
                            @if($sortBy == 'stock' && $orderBy == 'asc')
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.stock'),
                                ['id' => $id, 'sortBy' => 'stock', 'orderBy' => 'desc']
                                ) !!}
                            @else
                                {!! link_to_action(
                                'ProductsController@index', trans('admin/products/general.columns.stock'),
                                ['id' => $id, 'sortBy' => 'stock', 'orderBy' => 'asc']
                                ) !!}
                            @endif
                          </th>
                          <th>{{ trans('admin/products/general.columns.actions') }}</th>
                      </thead>
                      <tfoot>
                          <th>{{ trans('admin/products/general.columns.name') }}</th>
                          <th>{{ trans('admin/products/general.columns.hpp') }}</th>
                          <th>{{ trans('admin/products/general.columns.agenresmi_price') }}</th>
                          <th>{{ trans('admin/products/general.columns.agenlepas_price') }}</th>
                          <th>{{ trans('admin/products/general.columns.price') }}</th>
                          <th>{{ trans('admin/products/general.columns.stock') }}</th>
                          <th>{{ trans('admin/products/general.columns.actions') }}</th>
                      </tfoot>
                      <tbody>
                      @foreach($products as $p)
                          <tr>
                              <td class=""><a href="{{route('admin.products.edit', $p->id)}}">{{$p->name}}</a></td>
                              <td class="">{{ Helpers::reggo($p->hpp) }}</td>
                              <td class="">{{ Helpers::reggo($p->agenresmi_price) }}</td>
                              <td class="">{{ Helpers::reggo($p->agenlepas_price) }}</td>
                              <td class="">{{ Helpers::reggo($p->price) }}</td>
                              <td>
                                  {{-- {{ Form::select('stok', $stok, $p->stok, ['class'=>'form-control input-sm stok', 'id'=>$p->id, 'data-token'=>csrf_token()]) }} --}}
                                  {{$p->stock}}
                              </td>
                              <td>
                                  <a href="{!! route('admin.products.confirm-delete', $p->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table><!-- /.table -->
              </div><!-- /.mail-box-messages -->
          </div><!-- /.box-body -->

          <div class="box-footer no-padding">
              <div class="mailbox-controls">
                  {!! $products->render() !!}
              </div>
          </div>
      </div><!-- /. box -->
    </div><!-- /.col -->
  </div>

@endsection

@section('body_bottom')
  <!-- autocomplete UI -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

  <script>
      $(document).ready(function(){
          $('#search').autocomplete({
              source: '/admin/products/getInfo',
              minLength: 3,
              autoFocus: true,
              select:function(e,ui){
                  window.location = '/admin/products/'+ui.item.id+'/edit'
              }
          });
      });
  </script>
@stop