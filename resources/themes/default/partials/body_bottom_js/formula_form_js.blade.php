<!-- Vue JS -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.min.js" type="text/javascript"></script>

<!-- autocomplete UI -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
        $('#material_name').autocomplete({
            source   : '/admin/formulas/search',
            minLength: 2,
            autoFocus: true,
            select:function(e,ui){
                // asigning input column from the data that we got above
                vm.newMaterial.id = ui.item.id;
            }
        });

        $('#product_name').autocomplete({
            source   : '/admin/products/search',
            minLength: 2,
            autoFocus: true,
            select:function(e,ui){
                // asigning input column from the data that we got above
                $('#product_id').val(ui.item.id);
            }
        });
    });
    var vm = new Vue({
        el: '#form',

        data : {
            newMaterial: { id: '', name: '', qty: '' },
            materials: []
        },

        methods: {
            addMaterial: function () {
                if (this.newMaterial.id) {
                    this.materials.push(this.newMaterial);
                    this.newMaterial = { id: '', name: '', qty: '' };
                }
            },
            removeMaterial: function (item) {
                this.materials.$remove(item);
            }
        },
    });
</script>