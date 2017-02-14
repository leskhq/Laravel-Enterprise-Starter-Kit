@extends('layouts.print')

@section('content')

<div id="wrap">
	<table id="allset">
		<tbody>
			<tr>
				<td>
					<img width="114" vspace="0" hspace="0" height="45" border="0" src="{{ asset('img/logo-new.png') }}"><br>
				</td>
				<td align="center" width="500px">
					<h1 style="font-size:35px;margin:25px 0;">SPK</h1>
				</td>
			</tr>
		</tbody>
	</table>

	<hr width="100%" align="left" />

<div class='orchid' id='keterangan' style="margin-bottom:20px">
	<table id="allset">
		<tr>
			<th>No</th>
			<td>:</td>
			<td>PO-{{ $sale->customer->id.'-'.$sale->id.'-'. date("d-m-Y", strtotime($sale->order_date)) }}</td>
		</tr>
		<tr>
			<th>Customer</th>
			<td>:</td>
			<td>{{ $sale->customer->name }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>:</td>
			<td>{{ $sale->customer->laundry_name or '' }} {{ $sale->address }}</td>
		</tr>
		<tr>
			<th>Tanggal Estimasi</th>
			<td>:</td>
			<td>
				@if($sale->estimation_date == '0000-00-00')
					{{''}}
				@else
					{{ date('l, d F Y', strtotime($sale->estimation_date)) }}
				@endif
			</td>
		</tr>
	</table>
</div>

<div class='orchid' id='mitra'>
	<b>{{ $sale->customer->getCustomerTypeDisplayName() }}</b>
</div>

<table id="allset" >
	<tr class="trhead">
		<th class="bodered">No</th>
		<th class="bodered">Nama Produk</th>
		<th class="bodered">Jenis Spesifikasi</th>
		<th class="bodered">Qty Order</th>
		<th class="bodered">Keterangan</th>
		<th class="bodered">QC</th>
	</tr>
	<?php
		$no = 1;
		$nom = 0;
		$kg = 0;
		$totj = 0;
	?>
	@foreach($sale->saleDetails->sortBy('product_id') as $d)
		<?php
			$nom = $nom + $d->total;
			$kg = $kg + $d->weight;
		?>
		<tr class="trisi">
			<th class="bodered">{{ $no }}</th>
			<td class="bodered">{{ $d->product->name }}</td>
			<td class="bodered">{{ $d->description }}</td>
			<td class="bodered">{{ $d->quantity }}</td>
			<td class="bodered"></td>
			<td class="bodered"></td>
			<td >{{ $jer = $d->quantity / 5 }}</td>
		</tr>
		<?php $totj = $totj + $jer;  $no++; ?>
	@endforeach
</table>
<div id='ket'>
	<div class='kiri'>
		Ongkir
	</div><div class='tengah'>
		{{ Helpers::reggo($sale->shipping_fee) }}
	</div>
	<div class='kanan' id='ekspedisi'>
		<b>{{ $sale->expedition }}</b>
	</div>
	<div class='clearboth'></div>
	<div class='kiri'>
		Packing Kayu
	</div>
	<div class='tengah'>
		{{ Helpers::reggo($sale->packing_fee) }}
	</div>
	<div class='clearboth'></div>
</div>

</div>

@endsection
