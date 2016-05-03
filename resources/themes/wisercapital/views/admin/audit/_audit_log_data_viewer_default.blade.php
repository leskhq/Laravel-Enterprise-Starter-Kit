<div class="form-group">
    <label for="data">{!! trans('admin/audit/general.columns.data') !!}</label>
    @if ( $dataArray )
        {!! var_dump($dataArray) !!}
    @else
        <input class="form-control" readonly="readonly" name="data" type="text" value="{!! trans('admin/audit/general.error.no-data') !!}" id="data">
    @endif
</div>

