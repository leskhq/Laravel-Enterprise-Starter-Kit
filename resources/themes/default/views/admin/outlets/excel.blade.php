<table>
    <thead>
        <tr>
            <th>{{ trans('outlet/sales/general.columns.created') }}</th>
            <th>{{ trans('outlet/sales/general.columns.kilo_quantity') }}</th>
            <th>{{ trans('outlet/sales/general.columns.piece_quantity') }}</th>
            <th>{{ trans('outlet/sales/general.columns.total_kilo_cost') }}</th>
            <th>{{ trans('outlet/sales/general.columns.total_piece_cost') }}</th>
            <th>{{ trans('outlet/sales/general.columns.income') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($details as $sale)
        <tr>
            <td>{{ $sale->created_at }}</td>
            <td>{{ $sale->kilo_quantity }}</td>
            <td>{{ $sale->piece_quantity }}</td>
            <td>{{ Helpers::reggo($sale->total_kilo_cost) }}</td>
            <td>{{ Helpers::reggo($sale->total_piece_cost) }}</td>
            <td>{{ Helpers::reggo($sale->income) }}</td>
        </tr>
        @endforeach
        <tr>
            <td>TOTAL</td>
            <td>{{ $details->sum('kilo_quantity') }}</td>
            <td>{{ $details->sum('piece_quantity') }}</td>
            <td>{{ Helpers::reggo($details->sum('total_kilo_cost')) }}</td>
            <td>{{ Helpers::reggo($details->sum('total_piece_cost')) }}</td>
            <td>{{ Helpers::reggo($details->sum('income')) }}</td>
        </tr>
    </tbody>
</table>