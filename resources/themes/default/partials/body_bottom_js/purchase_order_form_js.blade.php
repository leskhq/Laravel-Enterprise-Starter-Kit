<!-- Vue JS -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.min.js" type="text/javascript"></script>

<!-- autocomplete UI -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        //  purchase order tab
        $('#supplier_name').autocomplete({
            source   : '/admin/suppliers/search',
            minLength: 3,
            autoFocus: true,
            select:function(e, ui){
                // asigning input column from the data that we got above
                $('#supplier_id').val(ui.item.id);
                vm.newMaterial.supplier      = ui.item.id;
                vm.newMaterial.supplier_name = ui.item.value;
            }
        });
        // details tab
        $('#material_name').autocomplete({
            source   : '/admin/formulas/search',
            minLength: 2,
            autoFocus: true,
            select:function(e,ui){
                // asigning input column from the data that we got above
                vm.newMaterial.id    = ui.item.id;
                vm.newMaterial.price = ui.item.price;
            }
        });
    });
    var vm = new Vue({
        el: '#form',

        data : {
            newMaterial: {
                id: '',
                name: '',
                quantity: '',
                total: 0,
                supplier: 0,
                supplier_name: '',
                description: '',
                price: 0
            },
            materials: []
        },

        methods: {
            addMaterial: function () {
                if (this.newMaterial.id) {
                    this.newMaterial.total = this.newMaterial.price * this.newMaterial.quantity;
                    this.materials.push(this.newMaterial);
                    this.newMaterial = { id: '', name: '', quantity: '', total: '', supplier: '', supplier_name: '', description: '', price: '' };
                }
            },
            removeMaterial: function (item) {
                this.materials.$remove(item);
            },
        }
    });
</script>