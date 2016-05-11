@extends('layouts.master')

@section('content')

<div class="row">

	 <div class='col-md-12'>
		 <div id="ScribbleMap" style="width: 100%; height: 600px"></div>
		 
	</div>
</div>

    <div class='row'>
        <div class='col-md-6'>
        
       
       
   <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Facility</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="" placeholder="Facility Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="address" class="col-sm-2 control-label">Facility Address</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="autocomplete" placeholder="Start typing address...">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                  
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
     
                <button type="submit" class="btn btn-info pull-right">Next</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>


    <input type="hidden" name="street_number" id="street_number">
	<input type="hidden" name="street" id="route"  name="street">
    <input type="hidden" name="city" id="locality">
    <input type="hidden" name="state" id="administrative_area_level_1">
	<input type="hidden" name="zip_code" id="postal_code">
	<input type="hidden" name="country" id="country">
			  
			  
			  
           
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgORS_FeRfsMPIM0PRdgp3JJ9fZiyhr38&libraries=places&callback=initAutocomplete" async defer></script>
<script type="text/javascript" src="//scribblemaps.com/api/js/"></script>


    <script language="JavaScript">
     
window.onload = function() {
          var sm = new scribblemaps.ScribbleMap('ScribbleMap', {
                searchControl: true,
                lineSettingsControl: false,
                mapTypeControl: true,
                fillColorControl: false,
                lineColorControl: false,
                zoomControl: true,
                tools: ["edit", "drag", "eraser",
                       "rectangle", 
                        "polygon"],
                defaultTool: "edit",
                startCenter: [43.00, -82.36116582031251],
                startZoom: 20,
                startMapType: "hybrid",
                disableZoom: false
            });
            
            sm.settings.setToImperial();
            console.log(sm.settings.getMeasurementUnits());
            
            
    }
    
    
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }


    
	</script>
@endsection
