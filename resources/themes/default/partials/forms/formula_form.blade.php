<div class="form-group">
    {!! Form::label('product_id', trans('admin/formulas/general.columns.product_id')) !!}
    {!! Form::hidden('product_id', null, ['id' => 'product_id']) !!}
    {!! Form::text('product[name]', null, ['class' => 'form-control', 'id' => 'product_name']) !!}
</div>

<div class="form-group">
    {!! Form::label('materials', trans('admin/formulas/general.columns.materials')) !!}
    <table class="table table-hover">
        <tr>
            <td>
                <input type="hidden" id="material_id" v-model="newMaterial.id">
                <input placeholder="name" type="text" v-model="newMaterial.name" id="material_name" class="form-control">
            </td>
            <td>
                <input placeholder="quantity" type="number" v-model="newMaterial.qty" class="form-control">
            </td>
            <td>
                <button class="btn btn-default" @click.prevent="addMaterial">
                    <i class="fa fa-plus-square"></i>
                </button>
            </td>
        </tr>
        <tr v-for="material in materials">
            <input type="hidden" name="material[@{{ $index }}][material_id]" value="@{{ material.id }}">
            <td><input type="text" value="@{{ material.name }}" disabled></td>
            <td><input name="material[@{{ $index }}][quantity]" type="text" value="@{{ material.qty }}"></td>
            <td>
                <a href="#" v-on:click.prevent="removeMaterial(index)"><i class="fa fa-times"></i></a>
            </td>
        </tr>
    </table>
</div>