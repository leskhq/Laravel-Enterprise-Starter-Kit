@extends('layouts.print')

@section('content')

<div class='orchid' id='keterangan'>
	<table id="allset" >
		<tr>
			<th>No</th>
			<td>:</td>
			<td>PO-{{ $sale->id.'-'. date("d-m-Y", strtotime($sale->order_date)) }}</td>
		</tr>
		<tr>
			<th>Customer</th>
			<td>:</td>
			<td>{{ $sale->customer->name }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>:</td>
			<td>{{ $sale->address }}</td>
		</tr>
		<tr>
			<th>Telepon</th>
			<td>:</td>
			<td>{{ $sale->phone }}</td>
		</tr>
		<tr>
			<th>Tanggal Order</th>
			<td>:</td>
			<td>{{ date('l, d F Y', strtotime($sale->order_date)) }}</td>
		</tr>
		<tr>
			<th>Tanggal Transfer</th>
			<td>:</td>
			<td>
				@if($sale->transfer_date == '0000-00-00' || $sale->transfer_date == null)
					{{''}}
				@else
					{{ date('l, d F Y', strtotime($sale->transfer_date))}}
				@endif
			</td>
		</tr>
		<tr>
			<th>Tanggal Estimasi</th>
			<td>:</td>
			<td>
				@if($sale->estimation_date == '0000-00-00')
					{{''}}
				@else
					{{$sale->estimation_date}}
				@endif
			</td>
		</tr>
		<tr>
			<th>Transfer Via</th>
			<td>:</td>
			<td>{{ $sale->transfer_via }}</td>
		</tr>
		<tr>
			<th>Tanggal Kirim</th>
			<td>:</td>
			<td>
				@if($sale->ship_date == '0000-00-00')
					{{''}}
				@else
					{{$sale->ship_date}}
				@endif
			</td>
		</tr>
		<tr>
			<th>Nomer Resi</th>
			<td>:</td>
			<td>{{ $sale->resi }}</td>
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
		<th class="bodered">Harga</th>
		<th class="bodered">Qty Order</th>
		<th class="bodered">Jumlah</th>
		<th class="bodered">Berat</th>
		<th class="bodered">QC</th>
	</tr>
	<?php
		$no = 1;
		$nom = 0;
		$kg = 0;
		$totj = 0;
	?>
	@foreach($sale->saleDetails as $d)
		<?php
			$nom = $nom + $d->total;
			$kg = $kg + $d->weight;
		?>
		<tr class="trisi">
			<th class="bodered">{{ $no }}</th>
			<td class="bodered">{{ $d->product->name }}</td>
			<td class="bodered">{{ $d->description }}</td>
			<td class="bodered">{{ Helpers::reggo($d->price) }}</td>
			<td class="bodered">{{ $d->quantity }}</td>
			<td class="bodered">{{ Helpers::reggo($d->total) }}</td>
			<td class="bodered">{{ $d->weight }} Kg</td>
			<td class="bodered"></td>
			<td >{{ $jer = $d->quantity / 5 }}</td>
		</tr>
		<?php $totj = $totj + $jer;  $no++; ?>
	@endforeach
	<tr class="trisi">
		<td class="bodered" colspan="2">Berat Kemasan</td>
		<td class="bodered"></td>
		<td class="bodered"></td>
		<td class="bodered"></td>
		<td class="bodered"></td>
		<th class="bodered">{{ $kg }} Kg</th>
	</tr>
	<tr class="trisi">
		<td class="bodered" colspan="2">Berat Packing</td>
		<td class="bodered"></td>
		<td class="bodered"></td>
		<td class="bodered"></td>
		<td class="bodered"></td>
		<th class="bodered">{{$kg/40}} Kg</th>
	</tr>
	<tr>
		<th colspan=5 class="bodered">Jumlah</th>
		<th class="bodered">{{ Helpers::reggo($nom) }}</th>
		<th class="bodered">{{$kg+($kg/40)}} Kg</th>
		<td></td>
		<th class="bodered">{{ $totj }}</th>
	</tr>
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
	<div class='kiri'>
		Total
	</div>
	<div class='tengah'>
		<b>{{ Helpers::reggo(($nom-$sale->discount) + $sale->shipping_fee + $sale->packing_fee) }}</b>
	</div>
	<div class='clearboth'></div>
	<div class='kiri'>
		Ket :
	</div>
	<div class='tengah' id="ketnya">
		<b>{!! nl2br($sale->description) !!}</b>
	</div>
	<div class='clearboth'></div>
</div>

@endsection
