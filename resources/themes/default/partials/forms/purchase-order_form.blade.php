<div class="form-group">
    {!! Form::label('description', trans('admin/purchase-orders/general.columns.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
    {!! Form::label('details', trans('admin/purchase-orders/general.columns.details')) !!}
    <table class="table table-hover">
        <tr>
            <td>
                <input type="text" placeholder="name" v-model="newMaterial.name" id="material_name" class="form-control">
            </td>
            <td>
                <input type="number" placeholder="quantity" v-model="newMaterial.quantity" class="form-control">
            </td>
            <td>
                <input type="hidden" id="supplier_id" v-model="newMaterial.supplier">
                <input type="text" id="supplier_name" v-model="newMaterial.supplier_name" placeholder="supplier" class="form-control">
            </td>
            <td>
                <input type="text" placeholder="description" v-model="newMaterial.description" class="form-control">
            </td>
            <td>
                <button class="btn btn-default" @click.prevent="addMaterial">
                    <i class="fa fa-plus-square"></i>
                </button>
            </td>
        </tr>
        <tr v-if="materials != ''">
            <th>{{ trans('admin/purchase-orders/general.detail.columns.material') }}</th>
            <th>{{ trans('admin/purchase-orders/general.detail.columns.price') }}</th>
            <th>{{ trans('admin/purchase-orders/general.detail.columns.quantity') }}</th>
            <th>Supplier</th>
            <th>{{ trans('admin/purchase-orders/general.detail.columns.description') }}</th>
            <th>{{ trans('admin/purchase-orders/general.detail.columns.total') }}</th>
            <th>{{ trans('admin/purchase-orders/general.columns.actions') }}</th>
        </tr>
        <tr v-for="material in materials">
            <input type="hidden" name="material[@{{ $index }}][material_id]" value="@{{ material.id }}">
            <td><input type="text" value="@{{ material.name }}" disabled></td>
            <td><input type="text" value="@{{ material.price }}" disabled></td>
            <td><input type="text" name="material[@{{ $index }}][quantity]" value="@{{ material.quantity }}" v-model="material.quantity"></td>
            <td>
                <input type="hidden" name="material[@{{ $index }}][supplier_id]" value="@{{ material.supplier }}">
                <input type="text" value="@{{ material.supplier_name }}" disabled>
            </td>
            <td><input type="text" name="material[@{{ $index }}][description]" value="@{{ material.description }}" v-model="material.description"></td>
            <td><input type="text" name="material[@{{ $index }}][total]" value="@{{ material.total = material.price * material.quantity }}"></td>
            <td>
                <a href="#" v-on:click.prevent="removeMaterial(material)"><i class="fa fa-times"></i></a>
            </td>
        </tr>
    </table>
</div>
