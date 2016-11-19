<table>
 <tbody>
  <tr>
    <th colspan="4">Data Penjualan Customer {{ $name }}</th>
  </tr>
  <tr>
   <th>No</th>
	 <th>Alamat</th>
	 <th>Nomor Telepon</th>
   <th>Tanggal Order</th>
	 <th>Tanggal Transfer</th>
   <th>Tanggal Kirim</th>
	 <th>Tanggal Estimasi</th>
   <th>Transfer Via</th>
   <th>Diskon</th>
   <th>Nominal</th>
   <th>Biaya Kirim</th>
	 <th>Biaya Packing</th>
	 <th>Ekspedisi</th>
  </tr>
  <?php
    $no = 1;
  ?>
  @foreach($sales as $p)
  <tr>
   <td>{{$no}}</td>
   <td>{{$p->address}}</td>
   <td>{{$p->phone}}</td>
   <td>{{$p->order_date}}</td>
   <td>{{$p->transfer_date}}</td>
	 <td>{{$p->ship_date}}</td>
	 <td>{{$p->estimation_date}}</td>
	 <td>{{$p->transfer_via}}</td>
	 <td>{{$p->discount}}</td>
	 <td>{{$p->nominal}}</td>
	 <td>{{$p->shipping_fee}}</td>
	 <td>{{$p->packing_fee}}</td>
	 <td>{{$p->expedition}}</td>
  </tr>
  <?php $no++; ?>
  @endforeach
 </tbody>
</table>

