@extends('layouts.master')

@section('content')



 <div class="row">
 	<div class="col-md-12">
	 	
	 	{!! Form::open(array('route' => 'hf.store', 'class' => 'form-horizontal')) !!}
	 	<div class="form-group">
			{!! Form::label('address', 'Facility Address', array('class' => 'col-sm-2 control-label')) !!}
		 	<div class="col-sm-8">
				{!! Form::text('address', null, array('id' => 'address-search', 'class' => 'form-control')) !!}
		 	</div>
	 	</div>
	 	
		<div class="form-group">
			<div class="col-sm-12">
				<div id="map-wrapper">
					<button type="button" id="delete-shapes"><i class="glyphicon glyphicon-erase"></i></button>
					<div id="map"></div>
    			</div>
			</div>
		</div>
		 
  		<div class="form-group">
  			{!! Form::label('address', 'Total Sqft', array('class' => 'col-sm-2 control-label')) !!}
  			<div class="col-sm-8">
  				<span class="hide" id="sqft"></span>
  				<p id="total-sqft" class="form-control-static"></p>
  		 	</div>
		</div>
    
    
  		<div class="form-group">
  			<div class="col-sm-offset-2 col-sm-10">
  				{!! Form::submit('Proceed', array("class" => "btn btn-default")) !!}
      		</div>
  		</div>
	  		
		{!! Form::hidden('address', NULL, ['id' => 'address']) !!}
  		{!! Form::hidden('city', NULL, ['id' => 'city']) !!}
  		{!! Form::hidden('state', NULL, ['id' => 'state']) !!}
  		{!! Form::hidden('zip_code', NULL, ['id' => 'zip-code']) !!}
  		{!! Form::hidden('country', NULL, ['id' => 'country']) !!}
  		{!! Form::hidden('user_id', Auth::user()->id) !!}
  		{!! Form::hidden('area', NULL, ['id' => 'area']) !!}
  		{!! Form::close() !!}
  	
	</div>
</div>

 		  
			   
@endsection
<!-- Optional bottom section for modals etc... -->
@section('body_bottom')



<style>
	#map-wrapper {
	    margin-bottom: 20px;
	    position: relative;
	}
	
	#map {
	    position: relative;
	    height: 450px;
	    width: 100%;
	    z-index: 1;
	}
	
	#delete-shapes {
	    background: #fff;
	    border:none;
	    border-radius: 2px;
	    -moz-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px;
	    -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px;
	    box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px;
	    font-size: 11px;
	    padding: 5px 5px 4px;
	    position: absolute;
	    top: 5px;
	    left: 510px;
	    z-index: 2;
	}
	
	#delete-shapes:hover {
	    background: rgb(235,235,235);
	}


</style>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3&libraries=drawing,places,geometry"></script>
<script language="JavaScript">
	$( document ).ready(function() {
	$('form').bind("keypress", function(e) {
		  if (e.keyCode == 13) {               
		    e.preventDefault();
		    return false;
		  }
		});
	});
		    
	 		
	(function () {
	    google.maps.event.addDomListener(window, 'load', initialize);
	
	    function initialize() {
	        var map,
	            drawingManager,
	            overlays = [],
	            marker,
	            place,
	            selectedShape,
	            autocomplete,
	
	            addressSearchInput = document.getElementById('address-search'),
	            streetInput = document.getElementById('address'),
	            cityInput = document.getElementById('city'),
	            stateInput = document.getElementById('state'),
	            countryInput = document.getElementById('country'),
	            postalCodeInput = document.getElementById('zip-code'),
	            sqft = document.getElementById('sqft'),
	            totalSqft = document.getElementById('total-sqft'),
	            deleteShapeButton = document.getElementById('delete-shapes');
	
	        map = new google.maps.Map(document.getElementById('map'), {
	            center: new google.maps.LatLng(37.09024, -95.712891),
	            zoom: 4,
	            mapTypeId: google.maps.MapTypeId.SATELLITE,
	            rotateControl : false,
	            streetViewControl: false
	        });
	
	        map.setTilt(0); // turns off angled view
	
	        autocomplete = new google.maps.places.Autocomplete(addressSearchInput);
	
	        autocomplete.addListener('place_changed', function () {
	            var placeDetails;
	
	            place = autocomplete.getPlace();
	            console.log(place);
	
	            placeDetails = getPlaceDetails(place);
	            streetInput.value = placeDetails.streetNumber + ' ' + placeDetails.streetName;
	            cityInput.value = placeDetails.city;
	            stateInput.value = placeDetails.state;
	            countryInput.value = placeDetails.country;
	            postalCodeInput.value = placeDetails.postalCode;
	
	            if (place.geometry.viewport) {
	                map.fitBounds(place.geometry.viewport);
	            } else {
	                marker = new google.maps.Marker({
	                    position: place.geometry.location,
	                    map: map
	                });
	                map.setCenter(place.geometry.location);
	                map.setZoom(24);
	            }
	        });
	
	        drawingManager = new google.maps.drawing.DrawingManager({
	            drawingMode: google.maps.drawing.OverlayType.CIRCLE,
	            drawingControl: true,
	            drawingControlOptions: {
	                position: google.maps.ControlPosition.TOP_CENTER,
	                drawingModes: [
	                    google.maps.drawing.OverlayType.CIRCLE,
	                    google.maps.drawing.OverlayType.POLYGON,
	                    google.maps.drawing.OverlayType.RECTANGLE
	                ]
	            },
	            polygonOptions: {
	                fillColor: '#67689B',
	                strokeColor: '#595989',
	                fillOpacity: 0.85,
	                strokeWeight: 1,
	                clickable: true,
	                editable: true,
	                draggable: true
	            },
	            rectangleOptions: {
	                fillColor: '#67689B',
	                strokeColor: '#595989',
	                fillOpacity: 0.85,
	                strokeWeight: 1,
	                clickable: true,
	                editable: true,
	                draggable: true
	            },
	            circleOptions: {
	                fillColor: '#67689B',
	                strokeColor: '#595989',
	                fillOpacity: 0.85,
	                strokeWeight: 1,
	                clickable: true,
	                editable: true,
	                zIndex: 1
	            }
	        });
	
	        drawingManager.setMap(map);
	
	        google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
	            var newShape = e.overlay;
	            overlays.push(e);
	            google.maps.event.addListener(newShape, 'click', function () {
	                setSelection(newShape);
	            });
	            setSelection(newShape);
	            displaySqft();
	        });
	
	        // Circle
	        google.maps.event.addListener(drawingManager, 'circlecomplete', function (circle) {
	            google.maps.event.addListener(circle, 'radius_changed', function () {
	                displaySqft();
	            });
	        });
	
	        // Polygon
	        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
	            var polygonPath = polygon.getPath();
	            google.maps.event.addListener(polygon, 'dragend', function () {
	                displaySqft();
	            });
	
	            google.maps.event.addListener(polygonPath, 'set_at', function () {
	                displaySqft();
	            });
	
	            google.maps.event.addListener(polygonPath, 'insert_at', function () {
	                displaySqft();
	            });
	        });
	
	        // Rectangle
	        google.maps.event.addListener(drawingManager, 'rectanglecomplete', function (rectangle) {
	            google.maps.event.addListener(rectangle, 'bounds_changed', function () {
	                displaySqft();
	            });
	        });
	
	        deleteShapeButton.addEventListener('click', function () {
	            deleteSelectedShape();
	        });
	
	        function clearSelection() {
	            if (selectedShape) {
	                selectedShape.setEditable(false);
	                selectedShape = null;
	            }
	        }
	
	        function setSelection(shape) {
	            clearSelection();
	            selectedShape = shape;
	            shape.setEditable(true);
	        }
	
	        function deleteSelectedShape() {
	            if (selectedShape) {
	                overlays.splice(findOverlayIndex(selectedShape), 1);
	                selectedShape.setMap(null);
	                selectedShape = null;
	                displaySqft();
	            }
	        }
	
	        function findOverlayIndex(shape) {
	            var index;
	            for (var i = 0, l = overlays.length; i < l; i++) {
	                if (shape === overlays[i].overlay) {
	                    index = i;
	                    break;
	                }
	            }
	            return index;
	        }
	
	        function getPlaceDetails(place) {
	            var streetFieldName = 'route',
	                streetFieldNumber = 'street_number',
	                cityFieldName = 'locality',
	                stateFieldName = 'administrative_area_level_1',
	                countryFieldName = 'country',
	                postalCodeFieldName = 'postal_code';
	
	                placeDetails = {
	                    streetName: '',
	                    streetNumber: '',
	                    city: '',
	                    state: '',
	                    country: '',
	                    postalCode: ''
	                };
	            if (place.address_components.length) {
	                for (var i = 0, l = place.address_components.length; i < l; i++) {
	                    var addressComponent = place.address_components[i];
	                    if (addressComponent.types.indexOf(streetFieldNumber) !== -1) {
	                        placeDetails.streetNumber = addressComponent.long_name;
	                    }
	                    if (addressComponent.types.indexOf(streetFieldName) !== -1) {
	                        placeDetails.streetName = addressComponent.long_name;
	                    }
	                    if (addressComponent.types.indexOf(cityFieldName) !== -1) {
	                        placeDetails.city = addressComponent.long_name;
	                    }
	                    if (addressComponent.types.indexOf(stateFieldName) !== -1) {
	                        placeDetails.state = addressComponent.long_name;
	                    }
	                    if (addressComponent.types.indexOf(countryFieldName) !== -1) {
	                        placeDetails.country = addressComponent.long_name;
	                    }
	                    if (addressComponent.types.indexOf(postalCodeFieldName) !== -1) {
	                        placeDetails.postalCode = addressComponent.long_name;
	                    }
	                }
	            }
	            return placeDetails;
	        }
	
	        function displaySqft() {
	            var areas = [],
	                totalArea = 0;
	
	            for (var i = 0, l = overlays.length; i < l; i++) {
	                var overlay = overlays[i],
	                    area;
	                switch (overlay.type) {
	                    case 'circle':
	                        area = getCircleArea(overlay);
	                        break;
	                    case 'rectangle':
	                        area = getRectangleArea(overlay);
	                        break;
	                    case 'polygon':
	                        area = getPolygonArea(overlay);
	                        break;
	                }
	                totalArea += area;
	                areas.push(area);
	            }
	            sqft.innerHTML = areas.join("<br />Area:  ");
	            totalSqft.innerHTML = totalArea;
	            document.getElementById("area").value = totalArea;
	        }
	
	        function getCircleArea(circle) {
	            var radius = circle.overlay.radius;
	            return sqmToSqft(radius * radius * Math.PI);
	        }
	
	        function getRectangleArea(rectangle) {
	            var bounds = rectangle.overlay.bounds;
	            var sw = bounds.getSouthWest(),
	                ne = bounds.getNorthEast(),
	                southWest = new google.maps.LatLng(sw.lat(), sw.lng()),
	                northEast = new google.maps.LatLng(ne.lat(), ne.lng()),
	                southEast = new google.maps.LatLng(sw.lat(), ne.lng()),
	                northWest = new google.maps.LatLng(ne.lat(), sw.lng());
	            return sqmToSqft(google.maps.geometry.spherical.computeArea([northEast, northWest, southWest, southEast]));
	        }
	
	        function getPolygonArea(polygon) {
	            return sqmToSqft(google.maps.geometry.spherical.computeArea(polygon.overlay.getPath()));
	        }
	
	        function sqmToSqft(sqm) {
	            return sqm * 10.764;
	        }
	    }
	})();
</script>
@endsection