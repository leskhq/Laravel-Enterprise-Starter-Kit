@extends('layouts.master')

@section('content')

<div class="row">
	
	
		  
        <button id="delete-button">Delete Selected Shape</button>



	<div class="top-bar">
            <input id="pac-input" class="controls" type="text" placeholder="Facility Address">
        </div>
        
        
  <div class="col-md-12">
        	<div id="map"></div>
		</div>
</div>

   
 
<div class="row">
 	<div class="col-md-12">
  		
  		{!! Form::open(array('route' => 'hf.store')) !!}
  		
  		 
  		
  		{!! Form::hidden('address', '1000 Brand Blvd') !!}
  		{!! Form::hidden('city', 'Glendale') !!}
  		{!! Form::hidden('state', 'CA') !!}
  		{!! Form::hidden('zip_code', '91206') !!}
  		{!! Form::hidden('user_id', Auth::user()->id) !!}
  		{!! Form::submit('Next') !!}
  		{!! Form::close() !!}
  	</div>
</div>

 
 
	
			  
			  
		        
        
        
			  
			   
@endsection


            <!-- Optional bottom section for modals etc... -->
@section('body_bottom')



<style type="text/css">
            #map, html, body {
                padding: 0;
                margin: 0;
                height: 460px;
            }
            .top-bar{
                padding: 20px 0;
                text-align: center;
            }
            #panel {
                font-family: Arial, sans-serif;
                font-size: 13px;
                float: right;
                width: 250px;
                margin: 10px;

            }

            #color-palette {
                clear: both;
            }

            .color-button {
                width: 14px;
                height: 14px;
                font-size: 0;
                margin: 2px;
                float: left;
                cursor: pointer;
            }

            #delete-button {
                margin-top: 5px;
            }
            .controls {
                margin-top: 5px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 45px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }

            #pac-input {
                background-color: #fff;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 0 11px 0 13px;
                text-overflow: ellipsis;
                width: 400px;
            }

            #pac-input:focus {
                border-color: #4d90fe;
            }

            .pac-container {
                font-family: Roboto;
            }
            footer{
                padding: 10px;
            }
        </style>




 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing,places,geometry"></script>


    <script language="JavaScript">
     		var drawingManager;
            var selectedShape;
            var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
            var selectedColor;
            var colorButtons = {};


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
                selectColor(shape.get('fillColor') || shape.get('strokeColor'));
            }

            function deleteSelectedShape() {
                if (selectedShape) {
                    selectedShape.setMap(null);
                }
            }

            function selectColor(color) {
                selectedColor = color;
                for (var i = 0; i < colors.length; ++i) {
                    var currColor = colors[i];
                    colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
                }

                // Retrieves the current options from the drawing manager and replaces the
                // stroke or fill color as appropriate.
//                var polylineOptions = drawingManager.get('polylineOptions');
//                polylineOptions.strokeColor = color;
//                drawingManager.set('polylineOptions', polylineOptions);

                var rectangleOptions = drawingManager.get('rectangleOptions');
                rectangleOptions.fillColor = color;
                drawingManager.set('rectangleOptions', rectangleOptions);

                var circleOptions = drawingManager.get('circleOptions');
                circleOptions.fillColor = color;
                drawingManager.set('circleOptions', circleOptions);

                var polygonOptions = drawingManager.get('polygonOptions');
                polygonOptions.fillColor = color;
                drawingManager.set('polygonOptions', polygonOptions);
            }

            function setSelectedShapeColor(color) {
                if (selectedShape) {
                    if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
                        selectedShape.set('strokeColor', color);
                    } else {
                        selectedShape.set('fillColor', color);
                    }
                }
            }

            function makeColorButton(color) {
                var button = document.createElement('span');
                button.className = 'color-button';
                button.style.backgroundColor = color;
                google.maps.event.addDomListener(button, 'click', function () {
                    selectColor(color);
                    setSelectedShapeColor(color);
                });

                return button;
            }

            function buildColorPalette() {
                var colorPalette = document.getElementById('color-palette');
                for (var i = 0; i < colors.length; ++i) {
                    var currColor = colors[i];
                    var colorButton = makeColorButton(currColor);
                    colorPalette.appendChild(colorButton);
                    colorButtons[currColor] = colorButton;
                }
                selectColor(colors[0]);
            }

            function initialize() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 4,
                    center: new google.maps.LatLng(37.09024, -95.712891),
                    zoomControl: true,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                });


//                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
//                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });

                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function () {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    // Clear out the old markers.
                    markers.forEach(function (marker) {
                        marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function (place) {
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));

                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });

                var polyOptions = {
                    strokeWeight: 0,
                    fillOpacity: 0.45,
                    editable: true
                };

                // Creates a drawing manager attached to the map that allows the user to draw
                // markers, lines, and shapes.
                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingControl: true,
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_LEFT,
                        drawingModes: [
                            google.maps.drawing.OverlayType.POLYGON,
                            google.maps.drawing.OverlayType.CIRCLE,
                            google.maps.drawing.OverlayType.RECTANGLE
                        ]
                    },
                    markerOptions: {
                        draggable: true
                    },
                    rectangleOptions: polyOptions,
                    circleOptions: polyOptions,
                    polygonOptions: polyOptions,
                    map: map
                });





                google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
                    if (e.type != google.maps.drawing.OverlayType.MARKER) {
                        // Switch back to non-drawing mode after drawing a shape.
                        drawingManager.setDrawingMode(null);

                        // Add an event listener that selects the newly-drawn shape when the user
                        // mouses down on it.
                        var newShape = e.overlay;
                        newShape.type = e.type;

                        google.maps.event.addListener(newShape, 'click', function () {
                            setSelection(newShape);

                            if (e.type === 'rectangle') {

                                latlngs = [];
                                rectangleBounds = newShape.getBounds();
                                rectangleNorthEastBounds = rectangleBounds.getNorthEast();
                                rectangleNorthEastBoundsLatBounds = rectangleNorthEastBounds.lat();
                                rectangleNorthEastBoundsLngBounds = rectangleNorthEastBounds.lng();
                                rectangleSouthWestBounds = rectangleBounds.getSouthWest();
                                rectangleSouthWestBoundsLatBounds = rectangleSouthWestBounds.lat();
                                rectangleSouthWestBoundsLngBounds = rectangleSouthWestBounds.lng();
                                latlngs[0] = [rectangleNorthEastBoundsLatBounds, rectangleNorthEastBoundsLngBounds];
                                latlngs[1] = [rectangleSouthWestBoundsLatBounds, rectangleSouthWestBoundsLngBounds];
                                rectangleNorthWestBounds = new google.maps.LatLng(rectangleNorthEastBoundsLatBounds, rectangleSouthWestBoundsLngBounds);
                                rectangleSouthEastBounds = new google.maps.LatLng(rectangleSouthWestBoundsLatBounds, rectangleNorthEastBoundsLngBounds);
                                rectanglePath = [rectangleNorthEastBounds, rectangleSouthEastBounds, rectangleSouthWestBounds, rectangleNorthWestBounds, rectangleNorthEastBounds];

                                rectangleArea = google.maps.geometry.spherical.computeArea(rectanglePath);
                                document.getElementById("rectangleStatus").innerHTML = ("<b>RECTANGLE AREA:  </b>" + rectangleArea.toFixed(2) * 10.764 + " SQFT");



                                ; // complete functions
                            } else if (e.type === 'polygon') {

                                polygonArea = google.maps.geometry.spherical.computeArea(newShape.getPath());
                                document.getElementById("polarea").innerHTML = ("<b>POLYGON AREA:  </b>" + polygonArea.toFixed(2) * 10.764 + " SQFT");




                                ; // complete functions
                            } else if (e.type === 'circle') {

                                circleRadius = mapCircle.getRadius();
                                document.getElementById("circleStatus").innerHTML = ("<b>CIRCLE RADIUS:  </b>" + circleRadius.toFixed(2) * 10.764 + " SQFT");


                            }
                        });


//                        //rectangle change
                        if (e.type === 'rectangle') {

                            google.maps.event.addListener(drawingManager, 'rectanglecomplete', function (mapRectangle) {
                                latlngs = [];
                                rectangleBounds = mapRectangle.getBounds();
                                rectangleNorthEastBounds = rectangleBounds.getNorthEast();
                                rectangleNorthEastBoundsLatBounds = rectangleNorthEastBounds.lat();
                                rectangleNorthEastBoundsLngBounds = rectangleNorthEastBounds.lng();
                                rectangleSouthWestBounds = rectangleBounds.getSouthWest();
                                rectangleSouthWestBoundsLatBounds = rectangleSouthWestBounds.lat();
                                rectangleSouthWestBoundsLngBounds = rectangleSouthWestBounds.lng();
                                latlngs[0] = [rectangleNorthEastBoundsLatBounds, rectangleNorthEastBoundsLngBounds];
                                latlngs[1] = [rectangleSouthWestBoundsLatBounds, rectangleSouthWestBoundsLngBounds];
                                rectangleNorthWestBounds = new google.maps.LatLng(rectangleNorthEastBoundsLatBounds, rectangleSouthWestBoundsLngBounds);
                                rectangleSouthEastBounds = new google.maps.LatLng(rectangleSouthWestBoundsLatBounds, rectangleNorthEastBoundsLngBounds);
                                rectanglePath = [rectangleNorthEastBounds, rectangleSouthEastBounds, rectangleSouthWestBounds, rectangleNorthWestBounds, rectangleNorthEastBounds];

                                rectangleArea = google.maps.geometry.spherical.computeArea(rectanglePath);

                                document.getElementById("rectangleStatus").innerHTML = ("<b>RECTANGLE AREA:  </b>" + rectangleArea.toFixed(2)* 10.764 + " SQFT");

                                google.maps.event.addListener(mapRectangle, 'bounds_changed', function () {
                                    latlngs = [];
                                    rectangleBounds = mapRectangle.getBounds();
                                    rectangleNorthEastBounds = rectangleBounds.getNorthEast();
                                    rectangleNorthEastBoundsLatBounds = rectangleNorthEastBounds.lat();
                                    rectangleNorthEastBoundsLngBounds = rectangleNorthEastBounds.lng();
                                    rectangleSouthWestBounds = rectangleBounds.getSouthWest();
                                    rectangleSouthWestBoundsLatBounds = rectangleSouthWestBounds.lat();
                                    rectangleSouthWestBoundsLngBounds = rectangleSouthWestBounds.lng();
                                    latlngs[0] = [rectangleNorthEastBoundsLatBounds, rectangleNorthEastBoundsLngBounds];
                                    latlngs[1] = [rectangleSouthWestBoundsLatBounds, rectangleSouthWestBoundsLngBounds];
                                    rectangleNorthWestBounds = new google.maps.LatLng(rectangleNorthEastBoundsLatBounds, rectangleSouthWestBoundsLngBounds);
                                    rectangleSouthEastBounds = new google.maps.LatLng(rectangleSouthWestBoundsLatBounds, rectangleNorthEastBoundsLngBounds);
                                    rectanglePath = [rectangleNorthEastBounds, rectangleSouthEastBounds, rectangleSouthWestBounds, rectangleNorthWestBounds, rectangleNorthEastBounds];

                                    rectangleArea = google.maps.geometry.spherical.computeArea(rectanglePath);
                                    document.getElementById("rectangleStatus").innerHTML = ("<b>RECTANGLE AREA:  </b>" + rectangleArea.toFixed(2)* 10.764 + " SQFT");
                                });


                            });

                        } else {
                            google.maps.event.addListener(drawingManager, 'circlecomplete', function (mapCircle) {
                                circleRadius = mapCircle.getRadius();
                                document.getElementById("circleStatus").innerHTML = ("<b>CIRCLE RADIUS:  </b>" + circleRadius.toFixed(2) * 10.764 + " SQFT");


                                google.maps.event.addListener(mapCircle, 'bounds_changed', function () {
                                    circleRadius = mapCircle.getRadius();
                                    document.getElementById("circleStatus").innerHTML = ("<b>CIRCLE RADIUS:  </b>" + circleRadius.toFixed(2)* 10.764 + " SQFT");
                                });
                            });
                        }




                        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (mapPolygon) {

                            polygonArea = google.maps.geometry.spherical.computeArea(mapPolygon.getPath());
                            document.getElementById("polarea").innerHTML = ("<b>POLYGON AREA:  </b>" + polygonArea.toFixed(2) * 10.764 + " SQFT");

                            google.maps.event.addListener(mapPolygon.getPath(), 'set_at', function () {
                                polygonArea = google.maps.geometry.spherical.computeArea(mapPolygon.getPath());
                                document.getElementById("polarea").innerHTML = ("<b>POLYGON AREA:  </b>" + polygonArea.toFixed(2) * 10.764 + " SQFT");
                            });
                            google.maps.event.addListener(mapPolygon.getPath(), 'insert_at', function () {
                                polygonArea = google.maps.geometry.spherical.computeArea(mapPolygon.getPath());
                                document.getElementById("polarea").innerHTML = ("<b>POLYGON AREA:  </b>" + polygonArea.toFixed(2) * 10.764 + " SQFT");
                            });

                        });



                        //Rectangle Drawing Event Listner


                        setSelection(newShape);

                    }
                });



                // Clear the current selection when the drawing mode is changed, or when the
                // map is clicked.
                google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
                google.maps.event.addListener(map, 'click', clearSelection);
                google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);

                buildColorPalette();
            }
            google.maps.event.addDomListener(window, 'load', initialize);




    
	</script>
@endsection
