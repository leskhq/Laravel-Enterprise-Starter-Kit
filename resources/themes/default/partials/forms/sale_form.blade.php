<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_details" data-toggle="tab" aria-expanded="true">{!! trans('general.tabs.customers') !!}</a></li>
        <li class=""><a href="#tab_options" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.details') !!}</a></li>
        <li class=""><a href="#tab_roles" data-toggle="tab" aria-expanded="false">{!! trans('general.tabs.items') !!}</a></li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane active" id="tab_details">
            <div class="form-group">
                {!! Form::hidden('customer_id', null, ['id' => 'customer_id']) !!}
                {!! Form::label('name', trans('admin/customers/general.columns.name')) !!}
                @if( isset($sale) )
                    {!! Form::text('name', $sale->customer->name, ['class' => 'form-control', 'disabled']) !!}
                @else
                    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'customer_name']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('type', trans('admin/customers/general.columns.type')) !!}
                @if( isset($sale) )
                    {!! Form::select('type', config('constant.customer-types'), $sale->customer->type, ['class' => 'form-control type', 'disabled']) !!}
                @else
                    {!! Form::select('type', config('constant.customer-types'), null, ['class' => 'form-control type']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('phone', trans('admin/customers/general.columns.phone')) !!}
                @if( isset($sale) )
                    {!! Form::text('phone', $sale->phone, ['class' => 'form-control phone']) !!}
                @else
                    {!! Form::text('phone', null, ['class' => 'form-control phone']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('address', trans('admin/customers/general.columns.address')) !!}
                @if( isset($sale) )
                    {!! Form::textarea('address', $sale->address, ['class' => 'form-control', 'id' => 'base-address', 'rows' => 3]) !!}
                @else
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'base-address']) !!}
                    {!! Form::select('address-2', ['default'=>'choose address'], null, ['class' => 'form-control', 'id' => 'sec-address']) !!}
                @endif
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_options">
            <div class="form-group">
                {!! Form::label('order_date', trans('admin/sales/general.columns.order_date')) !!}
                {!! Form::text('order_date', null, ['class' => 'form-control date']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('transfer_date', trans('admin/sales/general.columns.transfer_date')) !!}
                {!! Form::text('transfer_date', null, ['class' => 'form-control date']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('ship_date', trans('admin/sales/general.columns.ship_date')) !!}
                {!! Form::text('ship_date', null, ['class' => 'form-control date']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('estimation_date', trans('admin/sales/general.columns.estimation_date')) !!}
                {!! Form::text('estimation_date', null, ['class' => 'form-control date']) !!}
            </div>

            <div class="form-group select2-bootstrap-append">
                {!! Form::label('transfer_via', trans('admin/sales/general.columns.transfer_via')) !!}
                {!! Form::select('transfer_via', config('constant.banks'), null, ['class' => 'form-control', 'id' => 'bank', 'style' => "width: 100%"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('shipping_fee', trans('admin/sales/general.columns.shipping_fee')) !!}
                {!! Form::text('shipping_fee', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('packing_fee', trans('admin/sales/general.columns.packing_fee')) !!}
                {!! Form::text('packing_fee', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('resi', trans('admin/sales/general.columns.resi')) !!}
                {!! Form::text('resi', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('expedition', trans('admin/sales/general.columns.expedition')) !!}
                {!! Form::text('expedition', null, ['class' => 'form-control', 'id' => 'expedition']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('discount', trans('admin/sales/general.columns.discount')) !!}
                {!! Form::text('discount', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', trans('admin/sales/general.columns.description')) !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) !!}
            </div>
        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="tab_roles">
            <div class='ketPenjualan col-lg-5"'>
                {{ trans('admin/sales/detail.columns.weight') }} : <span class='weightTotal'>0</span>
            </div><div class='ketPenjualan col-lg-5"'>
                Jerigen : <span class='totalJer'>0</span>
            </div>

            <div class="myForm">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('admin/sales/detail.columns.name') }}</th>
                            <th>{{ trans('admin/sales/detail.columns.description') }}</th>
                            <th>{{ trans('admin/sales/detail.columns.price') }}</th>
                            <th>{{ trans('admin/sales/detail.columns.quantity') }}</th>
                            <th>{{ trans('admin/sales/detail.columns.total') }}</th>
                            <th>{{ trans('admin/sales/detail.columns.weight') }}</th>
                            <th colspan="2" style="text-align: center;">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( isset($sale) )
                            <?php $no = 1; ?>
                            @foreach( $sale->saleDetails as $key => $d )
                                <tr id="row{{ $d->id }}">
                                    <td>{{ $no }}</td>
                                        {!! Form::hidden('item['. $key .'][id]', $d->id) !!}
                                        {!! Form::hidden('item['. $key .'][product_id]', $d->product_id, ['id' => 'productName'. $no .'']) !!}
                                        {!! Form::hidden('baseWeight', $d->product->weight, ['id' => 'baseWeight'.$no.'']) !!}
                                    <td>
                                        {!! Form::text('productName', $d->product->name, ['id' => 'product'. $no .'', 'placeholder' => 'nama', 'class' => 'form-control product']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('item['. $key .'][description]', $d->description, ['placeholder' => 'description', 'class' => 'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::hidden('item['. $key .'][price]', $d->price, ['id' => 'price'. $no .'']) !!}
                                        {!! Form::text('price', $d->price, ['placeholder' => 'price', 'class' => 'form-control', 'id' => 'displayPrice'. $no .'', 'disabled']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('item['. $key .'][quantity]', $d->quantity, ['placeholder' => 'quantity', 'class' => 'form-control Qty','id' => 'Qty'. $no .'']) !!}
                                    </td>
                                    <td>
                                        {!! Form::hidden('item['. $key .'][total]', $d->total, ['id' => 'total'. $no .'']) !!}
                                        {!! Form::text('total', $d->total, ['placeholder' => 'total', 'class' => 'form-control', 'id' => 'displayTotal'. $no .'', 'disabled']) !!}
                                    </td>
                                    <td>
                                        {!! Form::hidden('item['. $key .'][weight]', $d->weight, ['id' => 'weight'. $no .'']) !!}
                                        {!! Form::text('weight', $d->weight, ['placeholder' => 'weight', 'class' => 'form-control sumWeight', 'id' => 'displayWeight'. $no .'', 'disabled']) !!}
                                    </td>
                                    <td id='jer{{$no}}' class='qtyJer' value=''>
                                        0
                                    </td>
                                    <td>
                                        <a class="delete" token="{{ csrf_token() }}" data-id='{{ $d->id }}'><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                            @for($x = $no; $x <=50; $x++)
                                <tr>
                                    <td>
                                        {!! $x !!}
                                        {!! Form::hidden('item['. $x .'][product_id]', '', ['id' => 'productName'. $x .'']) !!}
                                        {!! Form::hidden('baseWeight', '', ['id' => 'baseWeight'.$x.'']) !!}
                                    </td>

                                    <td>
                                        {!! Form::text('productName', '', ['id' => 'product'. $x .'', 'placeholder' => 'nama', 'class' => 'form-control product']) !!}
                                    </td>

                                    <td>
                                        {!! Form::text('item['. $x .'][description]', '', ['placeholder' => 'description', 'class' => 'aroma form-control', 'id' => 'aroma'. $x .'']) !!}
                                    </td>

                                    <td>
                                        {!! Form::hidden('item['. $x .'][price]', '', ['id' => 'price'. $x .'']) !!}
                                        {!! Form::text('price', '', ['placeholder' => 'price', 'class' => 'form-control', 'id' => 'displayPrice'. $x .'', 'disabled']) !!}
                                    </td>

                                    <td>
                                        {!! Form::text('item['. $x .'][quantity]', '', ['placeholder' => 'quantity', 'class' => 'form-control Qty', 'id' => 'Qty'. $x .'']) !!}
                                    </td>

                                    <td>
                                        {!! Form::hidden('item['. $x .'][total]', '', ['id' => 'total'. $x .'']) !!}
                                        {!! Form::text('total', '', ['placeholder' => 'total', 'class' => 'form-control', 'id' => 'displayTotal'. $x .'', 'disabled']) !!}
                                    </td>

                                    <td>
                                        {!! Form::hidden('item['. $x .'][weight]', '', ['id' => 'weight'. $x .'']) !!}
                                        {!! Form::text('weight', '', ['placeholder' => 'weight', 'class' => 'form-control sumWeight', 'id' => 'displayWeight'. $x .'', 'disabled']) !!}
                                    </td>

                                    <td id='jer{{$x}}' class='qtyJer' value='' colspan="2" style="text-align: center;">
                                        0
                                    </td>
                                </tr>
                            @endfor
                        @else
                            @for($x = 1; $x <=50; $x++)
                                <tr>
                                    <td>
                                        {!! $x !!}
                                        {!! Form::hidden('item['. $x .'][product_id]', '', ['id' => 'productName'. $x .'']) !!}
                                        {!! Form::hidden('baseWeight', '', ['id' => 'baseWeight'.$x.'']) !!}
                                    </td>

                                    <td>
                                        {!! Form::text('productName', '', ['id' => 'product'. $x .'', 'placeholder' => 'nama', 'class' => 'form-control product']) !!}
                                    </td>

                                    <td>
                                        {!! Form::text('item['. $x .'][description]', '', ['placeholder' => 'description', 'class' => 'aroma form-control', 'id' => 'aroma'. $x .'']) !!}
                                    </td>

                                    <td>
                                        {!! Form::hidden('item['. $x .'][price]', '', ['id' => 'price'. $x .'']) !!}
                                        {!! Form::text('price', '', ['placeholder' => 'price', 'class' => 'form-control', 'id' => 'displayPrice'. $x .'', 'disabled']) !!}
                                    </td>

                                    <td>
                                        {!! Form::text('item['. $x .'][quantity]', '', ['placeholder' => 'quantity', 'class' => 'form-control Qty', 'id' => 'Qty'. $x .'']) !!}
                                    </td>

                                    <td>
                                        {!! Form::hidden('item['. $x .'][total]', '', ['id' => 'total'. $x .'']) !!}
                                        {!! Form::text('total', '', ['placeholder' => 'total', 'class' => 'form-control', 'id' => 'displayTotal'. $x .'', 'disabled']) !!}
                                    </td>

                                    <td>
                                        {!! Form::hidden('item['. $x .'][weight]', '', ['id' => 'weight'. $x .'']) !!}
                                        {!! Form::text('weight', '', ['placeholder' => 'weight', 'class' => 'form-control sumWeight', 'id' => 'displayWeight'. $x .'', 'disabled']) !!}
                                    </td>

                                    <td id='jer{{$x}}' class='qtyJer' value='' colspan="2" style="text-align: center;">
                                        0
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
</div>
