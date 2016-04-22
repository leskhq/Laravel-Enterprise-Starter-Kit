@foreach($sales as $key => $sale)
<tr>
    <td>{!! link_to_route('admin.sales.show', $sale->customer->name, $sale->id) !!}</td>
    <td>{{ Helpers::date($sale->order_date) }}</td>
    <td>{{ Helpers::date($sale->transfer_date) }}</td>
    <td>{{ Helpers::reggo($sale->nominal) }}</td>
    <td>{{ Helpers::reggo($sale->nominal+$sale->shipping_fee+$sale->packing_fee) }}</td>
    <td>
        {!! Form::select('status', config('constant.sale-status'), $sale->status, ['class' => 'form-control status',  'data-id' => $sale->id, 'data-token' => csrf_token()]) !!}
    </td>
    <td>
        <a href="{!! route('admin.sales.edit', $sale->id) !!}" title="{{ trans('general.button.edit') }}"><i class="fa fa-pencil-square-o"></i></a>
        <a href="{!! route('admin.sales.confirm-delete', $sale->id) !!}" data-toggle="modal" data-target="#modal_dialog" title="{{ trans('general.button.delete') }}"><i class="fa fa-trash-o deletable"></i></a>
    </td>
</tr>
@endforeach
