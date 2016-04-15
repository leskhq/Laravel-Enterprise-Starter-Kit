<!-- autocomplete UI -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // hide 'sec-address' because we want to give 'address' input for a new customers
        $('#sec-address').attr('style', 'display:none');

        $('.date').datepicker({
          format: "yyyy-mm-dd",
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: false,
          autoclose: true
        });

        $('#customer_name').autocomplete({
          source   : '/admin/customers/search',
          minLength: 3,
          autoFocus: true,
          select:function(e,ui){
            var stations = $("#sec-address");
            // remove the assigning name in 'base-address' and assigning to 'sec-address'
            $('#base-address').attr('name','');
            stations.attr('name','address');

            // change the address input
            $('#base-address').hide(500);
            stations.show(500);

            // append the data to select box
            stations.empty();
            stations.append('<option value="default">Choose Address</option>');
            stations.append('<option value="' + ui.item.address +'">Rumah: ' + ui.item.address + '</option>');
            stations.append('<option value="' + ui.item.laundry_address +'">Laundry: ' + ui.item.laundry_address + '</option>');

            // asigning input column from the data that we got above
            $('#customer_id').val(ui.item.id);
            $('.type').val(ui.item.type);
            $('.phone').val(ui.item.phone);
          }
        });

        $('#bank').select2({});

        $('#expedition').autocomplete({
            source   : '/admin/expeditions/search',
            minLength: 3,
            autoFocus: true
        });


        $('.product').autocomplete({
            source       : '/admin/products/search',
            minLength    : 3,
            matchContains: true,
            selectFirst  : false,
            autoFocus    : true,
            select       : function(e, ui) {
                currentId = $(this).attr('id').replace('product', '');
                type      = $('#type').val();
                if(type == 1 || type == 3 || type == 6) {
                    $('#price'+currentId).val(ui.item.agenlepas_price);
                } else if(type == 2 || type == 7) {
                    $('#price'+currentId).val(ui.item.agenresmi_price);
                } else {
                    $('#price'+currentId).val(ui.item.price);
                }
                $(this).val('ui.item.value');
                $('#productName'+currentId).attr('weight', ui.item.weight);
                // $('#beratAwal'+currentId).val(ui.item.weight);
                $('#productName'+currentId).val(ui.item.id);
            }
        });

        $('.aroma').autocomplete({
            source: '/admin/products/aromaSearch',
            minLength: 2,
            autoFocus: true,
            select:function(e,ui){
                currentId = $(this).attr('id').replace('product','');
                $('#aroma'+currentId).val(ui.item.value);
            }
        });

        function myWeight() {
            var sum = 0;
            var jerSum = 0;
            $('.hitungbrt').each(function(){
                sum += parseFloat( $(this).val() || 0 );  //Or this.innerHTML, this.innerText
            });
            $('.qtyJer').each(function(){
                jerSum += parseFloat( $(this).text() );  //Or this.innerHTML, this.innerText
            });
            $('.weightTotal').empty().append(sum).fadeIn();
            $('.totalJer').empty().append(jerSum).fadeIn();
            console.log(sum);
        }

        $('.Qty').focusout(function() {
            var qty         = $(this).val();
            var currentId   = $(this).attr('id').replace('Qty','');
            var price       = $('#price'+currentId).val();
            var baseWeight  = $('#productName'+currentId).attr('weight');
            var weight      = $('#weight'+currentId).val();
            var weightTotal = qty*baseWeight;
            $('#total'+currentId).val(qty*price);
            $('#jer'+currentId).text(Math.round(qty/5));
            if(!isNaN(weightTotal)){
                $('#weight'+currentId).val(Math.round(weightTotal));
            }
            myWeight();
        });
    });
</script>
