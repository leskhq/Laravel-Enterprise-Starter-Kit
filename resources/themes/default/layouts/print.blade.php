<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="{{ asset('/bower_components/printcss/print.css') }}">
</head>
<script type="text/javascript">
  window.print();
</script>
<body>
	<div id="wrap">
		<table id="allset">
			<tbody>
				<tr>
					<td align="center">
						<p>
							<img width="219" vspace="0" hspace="0" height="90" border="0" src="{{ asset('img/logo-new.png') }}"><br>
						</p>
					</td>
					<td align="center">
						<p>
							<font size="5">OrchiD BranD</font><br>
							<font size="4"><b>Laundry CleaniQue</b></font><br>
							<font size="2">Kantor: Jl. Palagan Tentara Pelajar KM. 9, Sleman - Yogyakarta</font><br>
							<font size="2">Telp.(0274) 283-0339</font><br>
							<font size="3">www.BisnisLaundryKiloan.com - www.PeluangUsahaLaundry.com&nbsp;</font>
						</p>
					</td>
				</tr>
			</tbody>
		</table>

		<hr width="100%" align="left" />

		@yield('content')

	</div>
</body>
</html>
