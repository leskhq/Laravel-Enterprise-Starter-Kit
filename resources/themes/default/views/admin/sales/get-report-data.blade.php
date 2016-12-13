<?php
$totalChemicals  = 0;
$totalMaterials  = 0;
$totalEquipments = 0;
foreach ($sales as $key => $sale):
    $total               += $sale->nominal;
    $total_shipping_fee  += $sale->shipping_fee;
    $total_packing_fee   += $sale->packing_fee;
    foreach( $sale->saleDetails as $key => $d ):
        if( in_array($d->product->category, $chemicalIndex) ) {
            $totalChemicals += $d->total;
        } elseif ( in_array($d->product->category, $materialIndex) ) {
            $totalMaterials += $d->total;
        } else {
            $totalEquipments += $d->total;
        }
    endforeach; ?>
    <tr>
        <td>
            {!! link_to_route('admin.sales.show', $sale->id.'-'.date("d-m-Y", strtotime($sale->order_date)), $sale->id) !!}
        </td>
        <td>{{ $sale->customer->name }}</td>
	<td>{{ Helpers::getCustomerTypeDisplayName($sale->customer->type) }}</td>
        <td>{{ $sale->order_date }}</td>
        <td>{{ $sale->transfer_date }}</td>
        <td>
            <label class="label label-{{ $sale->getStatusDisplayColour() }}">
                {{ $sale->getStatusDisplayName() }}
            </label>
        </td>
        <td>{{ Helpers::reggo($totalChemicals) }}</td>
        <td>{{ Helpers::reggo($totalMaterials) }}</td>
        <td>{{ Helpers::reggo($totalEquipments) }}</td>
        <td>{{ Helpers::reggo($sale->shipping_fee) }}</td>
	<td>{{ Helpers::reggo($sale->packing_fee) }}</td>
        <td>{{ Helpers::reggo(($sale->nominal-$sale->discount)+$sale->shipping_fee+$sale->packing_fee) }}</td>
    </tr>
    <?php
        $totalChemicals  = 0;
        $totalMaterials  = 0;
        $totalEquipments = 0;
        $no++;
endforeach; ?>
<tr>
  <td>{{ $no-1 }}</td>
  <td colspan=5>
    {{ trans('admin/sales/general.columns.total') }}
  </td>
  <td>{{ Helpers::reggo($chemicals) }}</td>
  <td>{{ Helpers::reggo($materials) }}</td>
  <td>{{ Helpers::reggo($equipments) }}</td>
  <td>{{ Helpers::reggo($total_shipping_fee) }}</td>
  <td>{{ Helpers::reggo($total_packing_fee)  }}</td>
  <td>{{ Helpers::reggo($total + $total_shipping_fee + $total_packing_fee) }}</td>
</tr>
