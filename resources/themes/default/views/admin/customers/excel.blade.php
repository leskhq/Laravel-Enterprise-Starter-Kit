<table>
 <tbody>
  <tr>
    <th colspan="4">Data Customer {{Helpers::getCustomerTypeDisplayName($id)}}</th>
  </tr>
  <tr>
   <th>No</th>
   <th>Nama</th>
   <th>Email</th>
   <th>Alamat</th>
   <th>Nomor Telepon</th>
   <th>Status</th>
   <th>Sejak</th>
  </tr>
  <?php
    $no = 1;
  ?>
  @foreach($customers as $p)
  <tr>
   <td>{{$no}}</td>
   <td>{{$p->name}}</td>
   <td>{{$p->email}}</td>
   <td>{{$p->laundry_address ? $p->laundry_address : $p->address}}</td>
   <td>{{$p->phone}}</td>
   <td>{{Helpers::getCustomerStatusDisplayName($p->status)}}</td>
   <td>{{$p->created_at}}</td>
  </tr>
  <?php $no++; ?>
  @endforeach
  <tr>
    <th colspan="3">Total {{Helpers::getCustomerTypeDisplayName($id)}}</th>
    <td>{{count($customers)}}</td>
  </tr>
 </tbody>
</table>
