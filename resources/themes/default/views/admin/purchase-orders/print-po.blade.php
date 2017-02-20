<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Print Pembelanjaan</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bs-print.css">
</head>
<script type="text/javascript">
  window.print();
</script>
<body>
    <div class="container" style="margin-top:20px;">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-sm-9">
                <h2>CV. INDOTECH GROUP</h2>
                <h4>Jl. Palagan Tentara Pelajar Km. 9<br>Kamdanen - Sleman</h4>
                <h4>Yogyakarta</h4>
            </div>
            <div class="col-sm-3" style="text-align:right;">
                <img width="100%" class="logoKecil" src="/img/logo-itg.png" alt="logo InternetSlowdown_Day.gif">
                <br>
                <div class="divPertama" style="text-align:left;">
                    Purchase Order: {{ $purchaseOrder->id .'-'. $purchaseOrder->created_at }}<br>
                    PO No :<br>
                    Date: {{ $purchaseOrder->created_at }}
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Bahan</th>
                        <th>jumlah</th>
                        <th>unit</th>
                        <th>harga</th>
                        <th>total</th>
                        <th>vendor</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="thCenter" style="text-align:center;" colspan="5">total</th>
                        <th>{{ Helpers::reggo($purchaseOrder->total) }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($purchaseOrder->purchaseOrderDetails as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->material->name }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td>Kg/Lt</td>
                        <td>{{ Helpers::reggo($value->material->price) }}</td>
                        <td>{{ Helpers::reggo($value->total) }}</td>
                        <td>{{ $value->supplier->name }}</td>
                        <td>{{ $value->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-6 colNoPadding" style="padding:0;">
                <h5>Keterangan:</h5>
                <p>
                    {{ $purchaseOrder->description }}
                </p>
            </div>
            <div class="col-sm-6 colNoPadding" style="padding:0;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ordered by</th>
                            <th>prepared by</th>
                            <th>approved by</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>purchasing</th>
                            <th>BOD / GM</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td class="tdBesar" style="height:90px;"></td>
                            <td class="tdBesar" style="height:90px;"></td>
                            <td class="tdBesar" style="height:90px;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>