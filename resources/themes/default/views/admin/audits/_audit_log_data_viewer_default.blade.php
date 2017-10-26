
    @if ( $dataArray )
        <div class="form-group">
            <pre>
                {!! print_r($dataArray) !!}
            </pre>
        </div>
    @else
        <div class="form-group">
            <input class="form-control" readonly="readonly" name="data" type="text" value="{!! trans('admin/audits/general.error.no-data') !!}" id="data">
        </div>
    @endif

