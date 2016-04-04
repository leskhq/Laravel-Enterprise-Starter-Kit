@extends('layouts.master')

@section('head_extra')
    <!-- jVectorMap 1.2.2 -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-8'>
            <!-- SERVER HEALTH REPORT -->
            <!-- MAP & BOX PANE -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Location Report</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="row">
                        <div class="col-md-9 col-sm-8">
                            <div class="pad">
                                <!-- Map will be created here -->
                                <div id="world-map-markers" style="height: 325px;"></div>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-md-3 col-sm-4">
                            <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                <div class="description-block margin-bottom">
                                    <span id="mousespeed">Loading..</span>
                                    <h5 class="description-header">1024</h5>
                                    <span class="description-text">Avg. requests /s</span>
                                </div><!-- /.description-block -->
                                <div class="description-block margin-bottom">
                                    <div class="sparkbar pad" data-color="#fff">14,97,87,91,23,9,98</div>
                                    <h5 class="description-header">30%</h5>
                                    <span class="description-text">Bandwith</span>
                                </div><!-- /.description-block -->
                                <div class="description-block">
                                    <div class="sparkbar pad" data-color="#fff">82,66,40,89,21,53,78,28,62,54</div>
                                    <h5 class="description-header">70%</h5>
                                    <span class="description-text">Unique users</span>
                                </div><!-- /.description-block -->
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->


            <!-- PROJECT STATUS -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Project status</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @foreach($tasks as $task)
                        <h5>
                            {{ $task['name'] }}
                            <small class="label label-{{$task['color']}} pull-right">{{$task['progress']}}%</small>
                        </h5>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-{{$task['color']}}" style="width: {{$task['progress']}}%"></div>
                        </div>
                    @endforeach

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action='#'>
                        <input type='text' placeholder='New task' class='form-control input-sm' />
                    </form>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->

        </div><!-- /.col -->
        <div class='col-md-4'>
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Online Users</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">15 users online</span>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user1-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Alexander Pierce</a>
                            <span class="users-list-date">Today</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user8-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Norman</a>
                            <span class="users-list-date">Yesterday</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user7-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Jane</a>
                            <span class="users-list-date">12 Jan</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user6-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">John</a>
                            <span class="users-list-date">12 Jan</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Alexander</a>
                            <span class="users-list-date">13 Jan</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user5-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Sarah</a>
                            <span class="users-list-date">14 Jan</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user4-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Nora</a>
                            <span class="users-list-date">15 Jan</span>
                        </li>
                        <li>
                            <img src="{{ asset ("/bower_components/admin-lte/dist/img/user3-128x128.jpg") }}" alt="User Image">
                            <a class="users-list-name" href="#">Nadia</a>
                            <span class="users-list-date">15 Jan</span>
                        </li>
                    </ul><!-- /.users-list -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript::" class="uppercase">View All Users</a>
                </div><!-- /.box-footer -->
            </div>

            <!-- BROWSER USAGE -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Browser Usage</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div><!-- ./chart-responsive -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <ul class="chart-legend clearfix">
                                <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">United States of America <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                        <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
                        <li><a href="#">China <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                    </ul>
                </div><!-- /.footer -->
            </div>
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


@section('body_bottom')
    <!-- ChartJS -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/chartjs/chart.min.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: 700,
                color: "#f56954",
                highlight: "#f56954",
                label: "Chrome"
            },
            {
                value: 500,
                color: "#00a65a",
                highlight: "#00a65a",
                label: "IE"
            },
            {
                value: 400,
                color: "#f39c12",
                highlight: "#f39c12",
                label: "FireFox"
            },
            {
                value: 600,
                color: "#00c0ef",
                highlight: "#00c0ef",
                label: "Safari"
            },
            {
                value: 300,
                color: "#3c8dbc",
                highlight: "#3c8dbc",
                label: "Opera"
            },
            {
                value: 100,
                color: "#d2d6de",
                highlight: "#d2d6de",
                label: "Navigator"
            }
        ];
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 1,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
            //String - A tooltip template
            tooltipTemplate: "<%=value %> <%=label%> users"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
        //-----------------
        //- END PIE CHART -
        //-----------------
    </script>

    <!-- jvectormap -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        //----------------
        //- jVector Maps -
        //- Create a world map with markers
        //----------------
        $('#world-map-markers').vectorMap({
            map: 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity: 0.7,
            hoverColor: false,
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: 'rgba(210, 214, 222, 1)',
                    "fill-opacity": 1,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 1
                },
                hover: {
                    "fill-opacity": 0.7,
                    cursor: 'pointer'
                },
                selected: {
                    fill: 'yellow'
                },
                selectedHover: {
                }
            },
            markerStyle: {
                initial: {
                    fill: '#00a65a',
                    stroke: '#111'
                }
            },
            markers: [
                {latLng: [5.316667, -4.033333],     name: "Abidjan, Ivory Coast",                       style:{fill: 'orange', r:5}},
                {latLng: [5.55, -0.2],              name: "Accra, Ghana",                               style:{fill: 'red', r:5}},
                {latLng: [39.933333, 32.866667],    name: "Ankara, Turkey",                             style:{fill: 'lime', r:5}},
                {latLng: [37.966667, 23.716667],    name: "Athens, Greece",                             style:{fill: 'lime', r:5}},
                {latLng: [-34.603333, -58.381667],  name: "Buenos Aires, Argentina",                    style:{fill: 'lime', r:5}},
                {latLng: [13.105833, -59.613056],   name: "Bridgetown, Barbados",                       style:{fill: 'lime', r:5}},
                {latLng: [39.916667, 116.383333],   name: "Beijing, China",                             style:{fill: 'lime', r:5}},
                {latLng: [46.95, 7.45],             name: "Bern, Switzerland",                          style:{fill: 'lime', r:5}},
                {latLng: [33.886944, 35.513056],    name: "Beirut, Lebanon",                            style:{fill: 'lime', r:5}},
                {latLng: [4.598056, -74.075833],    name: "Bogotá, Colombia",                           style:{fill: 'lime', r:5}},
                {latLng: [44.816667, 20.466667],    name: "Belgrade, Serbia",                           style:{fill: 'lime', r:5}},
                {latLng: [47.4925, 19.051389],      name: "Budapest, Hungary",                          style:{fill: 'lime', r:5}},
                {latLng: [52.516667, 13.383333],    name: "Berlin, Germany",                            style:{fill: 'lime', r:5}},
                {latLng: [-15.793889, -47.882778],  name: "Brasília, Brazil",                           style:{fill: 'lime', r:5}},
                {latLng: [50.85, 4.35],             name: "Brussels, Belgium",                          style:{fill: 'lime', r:5}},
                {latLng: [44.4325, 26.103889],      name: "Bucharest, Romania",                         style:{fill: 'lime', r:5}},
                {latLng: [30.05, 31.233333],        name: "Cairo, Egypt",                               style:{fill: 'lime', r:5}},
                {latLng: [41.836944, -87.684722],   name: "Chicago, United States of America",          style:{fill: 'lime', r:5}},
                {latLng: [40.7127, -74.0059],       name: "New York City, United States of America",    style:{fill: 'lime', r:5}},
                {latLng: [55.676111, 12.568333],    name: "Copenhagen, Denmark",                        style:{fill: 'lime', r:5}},
                {latLng: [10.5, -66.916667],        name: "Caracas, Venezuela",                         style:{fill: 'lime', r:5}},
                {latLng: [14.692778, -17.446667],   name: "Dakar, Senegal",                             style:{fill: 'lime', r:5}},
                {latLng: [32.775833, -96.796667],   name: "Dallas, United States of America",           style:{fill: 'lime', r:5}},
                {latLng: [28.61, 77.23],            name: "Delhi, India",                               style:{fill: 'lime', r:5}},
                {latLng: [23.7, 90.366667],         name: "Dhaka, Bangladesh",                          style:{fill: 'lime', r:5}},
                {latLng: [23.133333, 113.266667],   name: "Guangzhou, People's Republic of China",      style:{fill: 'lime', r:5}},
                {latLng: [46.2, 6.15],              name: "Geneva, Switzerland",                        style:{fill: 'lime', r:5}},
                {latLng: [21.028472, 105.854167],   name: "Hanoi, Vietnam",                             style:{fill: 'lime', r:5}},
                {latLng: [23.133333, -82.383333],   name: "Havana, Cuba",                               style:{fill: 'orange', r:5}},
                {latLng: [22.25, 114.166667],       name: "Hong Kong, People's Republic of China",      style:{fill: 'lime', r:5}},
                {latLng: [60.133333, 25],           name: "Helsinki, Finland",                          style:{fill: 'lime', r:5}},
                {latLng: [3.133333, 101.683333],    name: "Kuala Lumpur, Malaysia",                     style:{fill: 'lime', r:5}},
                {latLng: [17.983333, -76.8],        name: "Kingston, Jamaica",                          style:{fill: 'lime', r:5}},
                {latLng: [50.45, 30.523333],        name: "Kiev, Ukraine",                              style:{fill: 'lime', r:5}},
                {latLng: [6.455027, 3.384082],      name: "Lagos, Nigeria",                             style:{fill: 'yellow', r:5}},
                {latLng: [51.507222, -0.1275],      name: "London, United Kingdom",                     style:{fill: 'lime', r:5}},
                {latLng: [34.05, -118.25],          name: "Los Angeles, United States of America",      style:{fill: 'lime', r:5}},
                {latLng: [38.713889, -9.139444],    name: "Lisbon, Portugal",                           style:{fill: 'lime', r:5}},
                {latLng: [40.383333, -3.716667],    name: "Madrid, Spain",                              style:{fill: 'lime', r:5}},
                {latLng: [25.775278, -80.208889],   name: "Miami, United States of America",            style:{fill: 'lime', r:5}},
                {latLng: [55.75, 37.616667],        name: "Moscow, Russia",                             style:{fill: 'lime', r:5}},
                {latLng: [-1.283333, 36.816667],    name: "Nairobi, Kenya",                             style:{fill: 'lime', r:5}},
                {latLng: [59.95, 10.75],            name: "Oslo, Norway",                               style:{fill: 'lime', r:5}},
                {latLng: [45.4166666666666, -75.7], name: "Ottawa, Canada",                             style:{fill: 'lime', r:5}},
                {latLng: [50.083333, 14.416667],    name: "Prague, Czech Republic",                     style:{fill: 'lime', r:5}},
                {latLng: [10.666667, -61.516667],   name: "Port of Spain, Trinidad and Tobago",         style:{fill: 'lime', r:5}},
                {latLng: [41.9, 12.5],              name: "Rome, Italy",                                style:{fill: 'lime', r:5}},
                {latLng: [18.466667, -69.95],       name: "Santo Domingo, Dominican Republic",          style:{fill: 'lime', r:5}},
                {latLng: [37.566667, 126.966667],   name: "Seoul, South Korea",                         style:{fill: 'lime', r:5}},
                {latLng: [31.2, 121.5],             name: "Shanghai, People's Republic of China",       style:{fill: 'lime', r:5}},
                {latLng: [9.933333, -84.083333],    name: "San José, Costa Rica",                       style:{fill: 'lime', r:5}},
                {latLng: [-23.55, -46.633333],      name: "São Paulo, Brazil",                          style:{fill: 'lime', r:5}},
                {latLng: [1.283333, 103.833333],    name: "Singapore",                                  style:{fill: 'lime', r:5}},
                {latLng: [-33.45, -70.666667],      name: "Santiago, Chile",                            style:{fill: 'lime', r:5}},
                {latLng: [59.329444, 18.068611],    name: "Stockholm, Sweden",                          style:{fill: 'lime', r:5}},
                {latLng: [25.033333, 121.633333],   name: "Taipei, Republic of China",                  style:{fill: 'lime', r:5}},
                {latLng: [35.683333, 139.683333],   name: "Tokyo, Japan",                               style:{fill: 'lime', r:5}},
                {latLng: [48.2, 16.366667],         name: "Vienna, Austria",                            style:{fill: 'lime', r:5}},
                {latLng: [52.233333, 21.016667],    name: "Warsaw, Poland",                             style:{fill: 'lime', r:5}},
                {latLng: [38.904722, -77.016389],   name: "Washington, D.C., United States of America", style:{fill: 'lime', r:5}},
                {latLng: [3.866667, 11.516667],     name: "Yaoundé, Cameroon",                          style:{fill: 'lime', r:5}},

//                {latLng: [-54.283333, -36.5], name: "King Edward Point, South Georgia and South Sandwich Islands", style:{fill: 'lime', r:5}},
//                {latLng: [-49.35, 70.216667], name: "Port-aux-Français, French Southern and Antarctic Lands", style:{fill: 'lime', r:5}},
//                {latLng: [31.7666666666666, 35.233333], name: "Jerusalem, Palestine", style:{fill: 'lime', r:5}},
//                {latLng: [60.116667, 19.9], name: "Mariehamn, Aland Islands", style:{fill: 'lime', r:5}},
//                {latLng: [-0.5477, 166.920867], name: "Yaren, Nauru", style:{fill: 'lime', r:5}},
//                {latLng: [18.0731, -63.0822], name: "Marigot, Saint Martin", style:{fill: 'lime', r:5}},
//                {latLng: [-9.166667, -171.833333], name: "Atafu, Tokelau", style:{fill: 'lime', r:5}},
//                {latLng: [27.153611, -13.203333], name: "El-AaiÃºn, Western Sahara", style:{fill: 'lime', r:5}},
//                {latLng: [34.5166666666666, 69.183333], name: "Kabul, Afghanistan", style:{fill: 'lime', r:5}},
//                {latLng: [41.3166666666666, 19.816667], name: "Tirana, Albania", style:{fill: 'lime', r:5}},
//                {latLng: [36.75, 3.05], name: "Algiers, Algeria", style:{fill: 'lime', r:5}},
//                {latLng: [-14.2666666666666, -170.7], name: "Pago Pago, American Samoa", style:{fill: 'lime', r:5}},
//                {latLng: [42.5, 1.516667], name: "Andorra la Vella, Andorra", style:{fill: 'lime', r:5}},
//                {latLng: [-8.83333333333333, 13.216667], name: "Luanda, Angola", style:{fill: 'lime', r:5}},
//                {latLng: [18.2166666666666, -63.05], name: "The Valley, Anguilla", style:{fill: 'lime', r:5}},
//                {latLng: [17.1166666666666, -61.85], name: "Saint John's, Antigua and Barbuda", style:{fill: 'lime', r:5}},
//                {latLng: [-34.5833333333333, -58.666667], name: "Buenos Aires, Argentina", style:{fill: 'lime', r:5}},
//                {latLng: [40.1666666666666, 44.5], name: "Yerevan, Armenia", style:{fill: 'lime', r:5}},
//                {latLng: [12.5166666666666, -70.033333], name: "Oranjestad, Aruba", style:{fill: 'red', r:5}},
//                {latLng: [-35.2666666666666, 149.133333], name: "Canberra, Australia", style:{fill: 'lime', r:5}},
//                {latLng: [48.2, 16.366667], name: "Vienna, Austria", style:{fill: 'lime', r:5}},
//                {latLng: [40.3833333333333, 49.866667], name: "Baku, Azerbaijan", style:{fill: 'lime', r:5}},
//                {latLng: [25.0833333333333, -77.35], name: "Nassau, Bahamas", style:{fill: 'lime', r:5}},
//                {latLng: [26.2333333333333, 50.566667], name: "Manama, Bahrain", style:{fill: 'lime', r:5}},
//                {latLng: [23.7166666666666, 90.4], name: "Dhaka, Bangladesh", style:{fill: 'lime', r:5}},
//                {latLng: [13.1, -59.616667], name: "Bridgetown, Barbados", style:{fill: 'lime', r:5}},
//                {latLng: [53.9, 27.566667], name: "Minsk, Belarus", style:{fill: 'lime', r:5}},
//                {latLng: [50.8333333333333, 4.333333], name: "Brussels, Belgium", style:{fill: 'lime', r:5}},
//                {latLng: [17.25, -88.766667], name: "Belmopan, Belize", style:{fill: 'lime', r:5}},
//                {latLng: [6.48333333333333, 2.616667], name: "Porto-Novo, Benin", style:{fill: 'lime', r:5}},
//                {latLng: [32.2833333333333, -64.783333], name: "Hamilton, Bermuda", style:{fill: 'lime', r:5}},
//                {latLng: [27.4666666666666, 89.633333], name: "Thimphu, Bhutan", style:{fill: 'lime', r:5}},
//                {latLng: [-16.5, -68.15], name: "La Paz, Bolivia", style:{fill: 'lime', r:5}},
//                {latLng: [43.8666666666666, 18.416667], name: "Sarajevo, Bosnia and Herzegovina", style:{fill: 'lime', r:5}},
//                {latLng: [-24.6333333333333, 25.9], name: "Gaborone, Botswana", style:{fill: 'lime', r:5}},
//                {latLng: [-15.7833333333333, -47.916667], name: "Brasilia, Brazil", style:{fill: 'lime', r:5}},
//                {latLng: [18.4166666666666, -64.616667], name: "Road Town, British Virgin Islands", style:{fill: 'lime', r:5}},
//                {latLng: [4.88333333333333, 114.933333], name: "Bandar Seri Begawan, Brunei Darussalam", style:{fill: 'lime', r:5}},
//                {latLng: [42.6833333333333, 23.316667], name: "Sofia, Bulgaria", style:{fill: 'lime', r:5}},
//                {latLng: [12.3666666666666, -1.516667], name: "Ouagadougou, Burkina Faso", style:{fill: 'lime', r:5}},
//                {latLng: [16.8, 96.15], name: "Rangoon, Myanmar", style:{fill: 'lime', r:5}},
//                {latLng: [-3.36666666666666, 29.35], name: "Bujumbura, Burundi", style:{fill: 'lime', r:5}},
//                {latLng: [11.55, 104.916667], name: "Phnom Penh, Cambodia", style:{fill: 'lime', r:5}},
//                {latLng: [3.86666666666666, 11.516667], name: "Yaounde, Cameroon", style:{fill: 'lime', r:5}},
//                {latLng: [45.4166666666666, -75.7], name: "Ottawa, Canada", style:{fill: 'lime', r:5}},
//                {latLng: [14.9166666666666, -23.516667], name: "Praia, Cape Verde", style:{fill: 'lime', r:5}},
//                {latLng: [19.3, -81.383333], name: "George Town, Cayman Islands", style:{fill: 'lime', r:5}},
//                {latLng: [4.36666666666666, 18.583333], name: "Bangui, Central African Republic", style:{fill: 'lime', r:5}},
//                {latLng: [12.1, 15.033333], name: "N'Djamena, Chad", style:{fill: 'yellow', r:5}},
//                {latLng: [-33.45, -70.666667], name: "Santiago, Chile", style:{fill: 'lime', r:5}},
//                {latLng: [39.9166666666666, 116.383333], name: "Beijing, China", style:{fill: 'lime', r:5}},
//                {latLng: [-10.4166666666666, 105.716667], name: "The Settlement, Christmas Island", style:{fill: 'lime', r:5}},
//                {latLng: [-12.1666666666666, 96.833333], name: "West Island, Cocos Islands", style:{fill: 'lime', r:5}},
//                {latLng: [4.6, -74.083333], name: "Bogota, Colombia", style:{fill: 'lime', r:5}},
//                {latLng: [-11.7, 43.233333], name: "Moroni, Comoros", style:{fill: 'lime', r:5}},
//                {latLng: [-4.31666666666666, 15.3], name: "Kinshasa, Democratic Republic of the Congo", style:{fill: 'lime', r:5}},
//                {latLng: [-4.25, 15.283333], name: "Brazzaville, Republic of Congo", style:{fill: 'lime', r:5}},
//                {latLng: [-21.2, -159.766667], name: "Avarua, Cook Islands", style:{fill: 'lime', r:5}},
//                {latLng: [9.93333333333333, -84.083333], name: "San Jose, Costa Rica", style:{fill: 'lime', r:5}},
//                {latLng: [6.81666666666666, -5.266667], name: "Yamoussoukro, Cote d'Ivoire", style:{fill: 'lime', r:5}},
//                {latLng: [45.8, 16], name: "Zagreb, Croatia", style:{fill: 'lime', r:5}},
//                {latLng: [23.1166666666666, -82.35], name: "Havana, Cuba", style:{fill: 'lime', r:5}},
//                {latLng: [12.1, -68.916667], name: "Willemstad, Curaçao", style:{fill: 'lime', r:5}},
//                {latLng: [35.1666666666666, 33.366667], name: "Nicosia, Cyprus", style:{fill: 'lime', r:5}},
//                {latLng: [50.0833333333333, 14.466667], name: "Prague, Czech Republic", style:{fill: 'lime', r:5}},
//                {latLng: [55.6666666666666, 12.583333], name: "Copenhagen, Denmark", style:{fill: 'lime', r:5}},
//                {latLng: [11.5833333333333, 43.15], name: "Djibouti, Djibouti", style:{fill: 'lime', r:5}},
//                {latLng: [15.3, -61.4], name: "Roseau, Dominica", style:{fill: 'lime', r:5}},
//                {latLng: [18.4666666666666, -69.9], name: "Santo Domingo, Dominican Republic", style:{fill: 'lime', r:5}},
//                {latLng: [-0.216666666666666, -78.5], name: "Quito, Ecuador", style:{fill: 'lime', r:5}},
//                {latLng: [30.05, 31.25], name: "Cairo, Egypt", style:{fill: 'lime', r:5}},
//                {latLng: [13.7, -89.2], name: "San Salvador, El Salvador", style:{fill: 'lime', r:5}},
//                {latLng: [3.75, 8.783333], name: "Malabo, Equatorial Guinea", style:{fill: 'lime', r:5}},
//                {latLng: [15.3333333333333, 38.933333], name: "Asmara, Eritrea", style:{fill: 'lime', r:5}},
//                {latLng: [59.4333333333333, 24.716667], name: "Tallinn, Estonia", style:{fill: 'lime', r:5}},
//                {latLng: [9.03333333333333, 38.7], name: "Addis Ababa, Ethiopia", style:{fill: 'red', r:5}},
//                {latLng: [-51.7, -57.85], name: "Stanley, Falkland Islands", style:{fill: 'lime', r:5}},
//                {latLng: [62, -6.766667], name: "Torshavn, Faroe Islands", style:{fill: 'lime', r:5}},
//                {latLng: [-18.1333333333333, 178.416667], name: "Suva, Fiji", style:{fill: 'lime', r:5}},
//                {latLng: [60.1666666666666, 24.933333], name: "Helsinki, Finland", style:{fill: 'lime', r:5}},
//                {latLng: [48.8666666666666, 2.333333], name: "Paris, France", style:{fill: 'lime', r:5}},
//                {latLng: [-17.5333333333333, -149.566667], name: "Papeete, French Polynesia", style:{fill: 'lime', r:5}},
//                {latLng: [0.383333333333333, 9.45], name: "Libreville, Gabon", style:{fill: 'lime', r:5}},
//                {latLng: [13.45, -16.566667], name: "Banjul, The Gambia", style:{fill: 'lime', r:5}},
//                {latLng: [41.6833333333333, 44.833333], name: "Tbilisi, Georgia", style:{fill: 'lime', r:5}},
//                {latLng: [52.5166666666666, 13.4], name: "Berlin, Germany", style:{fill: 'lime', r:5}},
//                {latLng: [5.55, -0.216667], name: "Accra, Ghana", style:{fill: 'lime', r:5}},
//                {latLng: [36.1333333333333, -5.35], name: "Gibraltar, Gibraltar", style:{fill: 'lime', r:5}},
//                {latLng: [37.9833333333333, 23.733333], name: "Athens, Greece", style:{fill: 'lime', r:5}},
//                {latLng: [64.1833333333333, -51.75], name: "Nuuk, Greenland", style:{fill: 'lime', r:5}},
//                {latLng: [12.05, -61.75], name: "Saint George's, Grenada", style:{fill: 'lime', r:5}},
//                {latLng: [13.4666666666666, 144.733333], name: "Hagatna, Guam", style:{fill: 'lime', r:5}},
//                {latLng: [14.6166666666666, -90.516667], name: "Guatemala City, Guatemala", style:{fill: 'lime', r:5}},
//                {latLng: [49.45, -2.533333], name: "Saint Peter Port, Guernsey", style:{fill: 'lime', r:5}},
//                {latLng: [9.5, -13.7], name: "Conakry, Guinea", style:{fill: 'lime', r:5}},
//                {latLng: [11.85, -15.583333], name: "Bissau, Guinea-Bissau", style:{fill: 'lime', r:5}},
//                {latLng: [6.8, -58.15], name: "Georgetown, Guyana", style:{fill: 'lime', r:5}},
//                {latLng: [18.5333333333333, -72.333333], name: "Port-au-Prince, Haiti", style:{fill: 'lime', r:5}},
//                {latLng: [41.9, 12.45], name: "Vatican City, Vatican City", style:{fill: 'lime', r:5}},
//                {latLng: [14.1, -87.216667], name: "Tegucigalpa, Honduras", style:{fill: 'lime', r:5}},
//                {latLng: [47.5, 19.083333], name: "Budapest, Hungary", style:{fill: 'lime', r:5}},
//                {latLng: [64.15, -21.95], name: "Reykjavik, Iceland", style:{fill: 'lime', r:5}},
//                {latLng: [28.6, 77.2], name: "New Delhi, India", style:{fill: 'lime', r:5}},
//                {latLng: [-6.16666666666666, 106.816667], name: "Jakarta, Indonesia", style:{fill: 'lime', r:5}},
//                {latLng: [35.7, 51.416667], name: "Tehran, Iran", style:{fill: 'lime', r:5}},
//                {latLng: [33.3333333333333, 44.4], name: "Baghdad, Iraq", style:{fill: 'lime', r:5}},
//                {latLng: [53.3166666666666, -6.233333], name: "Dublin, Ireland", style:{fill: 'lime', r:5}},
//                {latLng: [54.15, -4.483333], name: "Douglas, Isle of Man", style:{fill: 'yellow', r:5}},
//                {latLng: [31.7666666666666, 35.233333], name: "Jerusalem, Israel", style:{fill: 'lime', r:5}},
//                {latLng: [41.9, 12.483333], name: "Rome, Italy", style:{fill: 'lime', r:5}},
//                {latLng: [18, -76.8], name: "Kingston, Jamaica", style:{fill: 'lime', r:5}},
//                {latLng: [35.6833333333333, 139.75], name: "Tokyo, Japan", style:{fill: 'lime', r:5}},
//                {latLng: [49.1833333333333, -2.1], name: "Saint Helier, Jersey", style:{fill: 'lime', r:5}},
//                {latLng: [31.95, 35.933333], name: "Amman, Jordan", style:{fill: 'lime', r:5}},
//                {latLng: [51.1666666666666, 71.416667], name: "Astana, Kazakhstan", style:{fill: 'lime', r:5}},
//                {latLng: [-1.28333333333333, 36.816667], name: "Nairobi, Kenya", style:{fill: 'lime', r:5}},
//                {latLng: [-0.883333333333333, 169.533333], name: "Tarawa, Kiribati", style:{fill: 'lime', r:5}},
//                {latLng: [39.0166666666666, 125.75], name: "Pyongyang, North Korea", style:{fill: 'lime', r:5}},
//                {latLng: [37.55, 126.983333], name: "Seoul, South Korea", style:{fill: 'lime', r:5}},
//                {latLng: [42.6666666666666, 21.166667], name: "Pristina, Kosovo", style:{fill: 'lime', r:5}},
//                {latLng: [29.3666666666666, 47.966667], name: "Kuwait City, Kuwait", style:{fill: 'lime', r:5}},
//                {latLng: [42.8666666666666, 74.6], name: "Bishkek, Kyrgyzstan", style:{fill: 'lime', r:5}},
//                {latLng: [17.9666666666666, 102.6], name: "Vientiane, Laos", style:{fill: 'lime', r:5}},
//                {latLng: [56.95, 24.1], name: "Riga, Latvia", style:{fill: 'lime', r:5}},
//                {latLng: [33.8666666666666, 35.5], name: "Beirut, Lebanon", style:{fill: 'lime', r:5}},
//                {latLng: [-29.3166666666666, 27.483333], name: "Maseru, Lesotho", style:{fill: 'lime', r:5}},
//                {latLng: [6.3, -10.8], name: "Monrovia, Liberia", style:{fill: 'lime', r:5}},
//                {latLng: [32.8833333333333, 13.166667], name: "Tripoli, Libya", style:{fill: 'lime', r:5}},
//                {latLng: [47.1333333333333, 9.516667], name: "Vaduz, Liechtenstein", style:{fill: 'lime', r:5}},
//                {latLng: [54.6833333333333, 25.316667], name: "Vilnius, Lithuania", style:{fill: 'lime', r:5}},
//                {latLng: [49.6, 6.116667], name: "Luxembourg, Luxembourg", style:{fill: 'lime', r:5}},
//                {latLng: [42, 21.433333], name: "Skopje, Macedonia", style:{fill: 'lime', r:5}},
//                {latLng: [-18.9166666666666, 47.516667], name: "Antananarivo, Madagascar", style:{fill: 'lime', r:5}},
//                {latLng: [-13.9666666666666, 33.783333], name: "Lilongwe, Malawi", style:{fill: 'lime', r:5}},
//                {latLng: [3.16666666666666, 101.7], name: "Kuala Lumpur, Malaysia", style:{fill: 'lime', r:5}},
//                {latLng: [4.16666666666666, 73.5], name: "Male, Maldives", style:{fill: 'lime', r:5}},
//                {latLng: [12.65, -8], name: "Bamako, Mali", style:{fill: 'lime', r:5}},
//                {latLng: [35.8833333333333, 14.5], name: "Valletta, Malta", style:{fill: 'lime', r:5}},
//                {latLng: [7.1, 171.383333], name: "Majuro, Marshall Islands", style:{fill: 'lime', r:5}},
//                {latLng: [18.0666666666666, -15.966667], name: "Nouakchott, Mauritania", style:{fill: 'lime', r:5}},
//                {latLng: [-20.15, 57.483333], name: "Port Louis, Mauritius", style:{fill: 'lime', r:5}},
//                {latLng: [19.4333333333333, -99.133333], name: "Mexico City, Mexico", style:{fill: 'lime', r:5}},
//                {latLng: [6.91666666666666, 158.15], name: "Palikir, Federated States of Micronesia", style:{fill: 'lime', r:5}},
//                {latLng: [47, 28.85], name: "Chisinau, Moldova", style:{fill: 'lime', r:5}},
//                {latLng: [43.7333333333333, 7.416667], name: "Monaco, Monaco", style:{fill: 'lime', r:5}},
//                {latLng: [47.9166666666666, 106.916667], name: "Ulaanbaatar, Mongolia", style:{fill: 'lime', r:5}},
//                {latLng: [42.4333333333333, 19.266667], name: "Podgorica, Montenegro", style:{fill: 'lime', r:5}},
//                {latLng: [16.7, -62.216667], name: "Plymouth, Montserrat", style:{fill: 'lime', r:5}},
//                {latLng: [34.0166666666666, -6.816667], name: "Rabat, Morocco", style:{fill: 'yellow', r:5}},
//                {latLng: [-25.95, 32.583333], name: "Maputo, Mozambique", style:{fill: 'lime', r:5}},
//                {latLng: [-22.5666666666666, 17.083333], name: "Windhoek, Namibia", style:{fill: 'lime', r:5}},
//                {latLng: [27.7166666666666, 85.316667], name: "Kathmandu, Nepal", style:{fill: 'lime', r:5}},
//                {latLng: [52.35, 4.916667], name: "Amsterdam, Netherlands", style:{fill: 'lime', r:5}},
//                {latLng: [-22.2666666666666, 166.45], name: "Noumea, New Caledonia", style:{fill: 'lime', r:5}},
//                {latLng: [-41.3, 174.783333], name: "Wellington, New Zealand", style:{fill: 'lime', r:5}},
//                {latLng: [12.1333333333333, -86.25], name: "Managua, Nicaragua", style:{fill: 'lime', r:5}},
//                {latLng: [13.5166666666666, 2.116667], name: "Niamey, Niger", style:{fill: 'lime', r:5}},
//                {latLng: [9.08333333333333, 7.533333], name: "Abuja, Nigeria", style:{fill: 'lime', r:5}},
//                {latLng: [-19.0166666666666, -169.916667], name: "Alofi, Niue", style:{fill: 'lime', r:5}},
//                {latLng: [-29.05, 167.966667], name: "Kingston, Norfolk Island", style:{fill: 'lime', r:5}},
//                {latLng: [15.2, 145.75], name: "Saipan, Northern Mariana Islands", style:{fill: 'lime', r:5}},
//                {latLng: [59.9166666666666, 10.75], name: "Oslo, Norway", style:{fill: 'lime', r:5}},
//                {latLng: [23.6166666666666, 58.583333], name: "Muscat, Oman", style:{fill: 'lime', r:5}},
//                {latLng: [33.6833333333333, 73.05], name: "Islamabad, Pakistan", style:{fill: 'lime', r:5}},
//                {latLng: [7.48333333333333, 134.633333], name: "Melekeok, Palau", style:{fill: 'lime', r:5}},
//                {latLng: [8.96666666666666, -79.533333], name: "Panama City, Panama", style:{fill: 'lime', r:5}},
//                {latLng: [-9.45, 147.183333], name: "Port Moresby, Papua New Guinea", style:{fill: 'lime', r:5}},
//                {latLng: [-25.2666666666666, -57.666667], name: "Asuncion, Paraguay", style:{fill: 'lime', r:5}},
//                {latLng: [-12.05, -77.05], name: "Lima, Peru", style:{fill: 'lime', r:5}},
//                {latLng: [14.6, 120.966667], name: "Manila, Philippines", style:{fill: 'lime', r:5}},
//                {latLng: [-25.0666666666666, -130.083333], name: "Adamstown, Pitcairn Islands", style:{fill: 'lime', r:5}},
//                {latLng: [52.25, 21], name: "Warsaw, Poland", style:{fill: 'lime', r:5}},
//                {latLng: [38.7166666666666, -9.133333], name: "Lisbon, Portugal", style:{fill: 'lime', r:5}},
//                {latLng: [18.4666666666666, -66.116667], name: "San Juan, Puerto Rico", style:{fill: 'lime', r:5}},
//                {latLng: [25.2833333333333, 51.533333], name: "Doha, Qatar", style:{fill: 'lime', r:5}},
//                {latLng: [44.4333333333333, 26.1], name: "Bucharest, Romania", style:{fill: 'red', r:5}},
//                {latLng: [55.75, 37.6], name: "Moscow, Russia", style:{fill: 'lime', r:5}},
//                {latLng: [-1.95, 30.05], name: "Kigali, Rwanda", style:{fill: 'lime', r:5}},
//                {latLng: [17.8833333333333, -62.85], name: "Gustavia, Saint Barthelemy", style:{fill: 'lime', r:5}},
//                {latLng: [-15.9333333333333, -5.716667], name: "Jamestown, Saint Helena", style:{fill: 'lime', r:5}},
//                {latLng: [17.3, -62.716667], name: "Basseterre, Saint Kitts and Nevis", style:{fill: 'lime', r:5}},
//                {latLng: [14, -61], name: "Castries, Saint Lucia", style:{fill: 'lime', r:5}},
//                {latLng: [46.7666666666666, -56.183333], name: "Saint-Pierre, Saint Pierre and Miquelon", style:{fill: 'lime', r:5}},
//                {latLng: [13.1333333333333, -61.216667], name: "Kingstown, Saint Vincent and the Grenadines", style:{fill: 'lime', r:5}},
//                {latLng: [-13.8166666666666, -171.766667], name: "Apia, Samoa", style:{fill: 'lime', r:5}},
//                {latLng: [43.9333333333333, 12.416667], name: "San Marino, San Marino", style:{fill: 'lime', r:5}},
//                {latLng: [0.333333333333333, 6.733333], name: "Sao Tome, Sao Tome and Principe", style:{fill: 'lime', r:5}},
//                {latLng: [24.65, 46.7], name: "Riyadh, Saudi Arabia", style:{fill: 'red', r:5}},
//                {latLng: [14.7333333333333, -17.633333], name: "Dakar, Senegal", style:{fill: 'lime', r:5}},
//                {latLng: [44.8333333333333, 20.5], name: "Belgrade, Serbia", style:{fill: 'lime', r:5}},
//                {latLng: [-4.61666666666666, 55.45], name: "Victoria, Seychelles", style:{fill: 'lime', r:5}},
//                {latLng: [8.48333333333333, -13.233333], name: "Freetown, Sierra Leone", style:{fill: 'lime', r:5}},
//                {latLng: [1.28333333333333, 103.85], name: "Singapore, Singapore", style:{fill: 'lime', r:5}},
//                {latLng: [18.0166666666666, -63.033333], name: "Philipsburg, Sint Maarten", style:{fill: 'lime', r:5}},
//                {latLng: [48.15, 17.116667], name: "Bratislava, Slovakia", style:{fill: 'lime', r:5}},
//                {latLng: [46.05, 14.516667], name: "Ljubljana, Slovenia", style:{fill: 'lime', r:5}},
//                {latLng: [-9.43333333333333, 159.95], name: "Honiara, Solomon Islands", style:{fill: 'lime', r:5}},
//                {latLng: [2.06666666666666, 45.333333], name: "Mogadishu, Somalia", style:{fill: 'lime', r:5}},
//                {latLng: [-25.7, 28.216667], name: "Pretoria, South Africa", style:{fill: 'lime', r:5}},
//                {latLng: [4.85, 31.616667], name: "Juba, South Sudan", style:{fill: 'lime', r:5}},
//                {latLng: [40.4, -3.683333], name: "Madrid, Spain", style:{fill: 'lime', r:5}},
//                {latLng: [6.91666666666666, 79.833333], name: "Colombo, Sri Lanka", style:{fill: 'lime', r:5}},
//                {latLng: [15.6, 32.533333], name: "Khartoum, Sudan", style:{fill: 'lime', r:5}},
//                {latLng: [5.83333333333333, -55.166667], name: "Paramaribo, Suriname", style:{fill: 'lime', r:5}},
//                {latLng: [78.2166666666666, 15.633333], name: "Longyearbyen, Svalbard", style:{fill: 'lime', r:5}},
//                {latLng: [-26.3166666666666, 31.133333], name: "Mbabane, Swaziland", style:{fill: 'lime', r:5}},
//                {latLng: [59.3333333333333, 18.05], name: "Stockholm, Sweden", style:{fill: 'lime', r:5}},
//                {latLng: [46.9166666666666, 7.466667], name: "Bern, Switzerland", style:{fill: 'lime', r:5}},
//                {latLng: [33.5, 36.3], name: "Damascus, Syria", style:{fill: 'lime', r:5}},
//                {latLng: [25.0333333333333, 121.516667], name: "Taipei, Taiwan", style:{fill: 'lime', r:5}},
//                {latLng: [38.55, 68.766667], name: "Dushanbe, Tajikistan", style:{fill: 'lime', r:5}},
//                {latLng: [-6.8, 39.283333], name: "Dar es Salaam, Tanzania", style:{fill: 'lime', r:5}},
//                {latLng: [13.75, 100.516667], name: "Bangkok, Thailand", style:{fill: 'lime', r:5}},
//                {latLng: [-8.58333333333333, 125.6], name: "Dili, Timor-Leste", style:{fill: 'lime', r:5}},
//                {latLng: [6.11666666666666, 1.216667], name: "Lome, Togo", style:{fill: 'lime', r:5}},
//                {latLng: [-21.1333333333333, -175.2], name: "Nuku'alofa, Tonga", style:{fill: 'yellow', r:5}},
//                {latLng: [10.65, -61.516667], name: "Port of Spain, Trinidad and Tobago", style:{fill: 'lime', r:5}},
//                {latLng: [36.8, 10.183333], name: "Tunis, Tunisia", style:{fill: 'lime', r:5}},
//                {latLng: [39.9333333333333, 32.866667], name: "Ankara, Turkey", style:{fill: 'lime', r:5}},
//                {latLng: [37.95, 58.383333], name: "Ashgabat, Turkmenistan", style:{fill: 'lime', r:5}},
//                {latLng: [21.4666666666666, -71.133333], name: "Grand Turk, Turks and Caicos Islands", style:{fill: 'lime', r:5}},
//                {latLng: [-8.51666666666666, 179.216667], name: "Funafuti, Tuvalu", style:{fill: 'lime', r:5}},
//                {latLng: [0.316666666666666, 32.55], name: "Kampala, Uganda", style:{fill: 'lime', r:5}},
//                {latLng: [50.4333333333333, 30.516667], name: "Kyiv, Ukraine", style:{fill: 'lime', r:5}},
//                {latLng: [24.4666666666666, 54.366667], name: "Abu Dhabi, United Arab Emirates", style:{fill: 'lime', r:5}},
//                {latLng: [51.5, -0.083333], name: "London, United Kingdom", style:{fill: 'lime', r:5}},
//                {latLng: [38.883333, -77], name: "Washington, D.C., United States", style:{fill: 'lime', r:5}},
//                {latLng: [-34.85, -56.166667], name: "Montevideo, Uruguay", style:{fill: 'lime', r:5}},
//                {latLng: [41.3166666666666, 69.25], name: "Tashkent, Uzbekistan", style:{fill: 'lime', r:5}},
//                {latLng: [-17.7333333333333, 168.316667], name: "Port-Vila, Vanuatu", style:{fill: 'lime', r:5}},
//                {latLng: [10.4833333333333, -66.866667], name: "Caracas, Venezuela", style:{fill: 'lime', r:5}},
//                {latLng: [21.0333333333333, 105.85], name: "Hanoi, Vietnam", style:{fill: 'lime', r:5}},
//                {latLng: [18.35, -64.933333], name: "Charlotte Amalie, US Virgin Islands", style:{fill: 'lime', r:5}},
//                {latLng: [-13.95, -171.933333], name: "Mata-Utu, Wallis and Futuna", style:{fill: 'lime', r:5}},
//                {latLng: [15.35, 44.2], name: "Sanaa, Yemen", style:{fill: 'yellow', r:5}},
//                {latLng: [-15.4166666666666, 28.283333], name: "Lusaka, Zambia", style:{fill: 'lime', r:5}},
//                {latLng: [-17.8166666666666, 31.033333], name: "Harare, Zimbabwe", style:{fill: 'lime', r:5}},
//                {latLng: [38.883333, -77], name: "Washington, D.C., US Minor Outlying Islands", style:{fill: 'lime', r:5}},
//                {latLng: [0, 0], name: "N/A, Antarctica", style:{fill: 'lime', r:5}},
//                {latLng: [35.183333, 33.366667], name: "North Nicosia, Northern Cyprus", style:{fill: 'lime', r:5}},
//                {latLng: [0, 0], name: "N/A, Hong Kong", style:{fill: 'lime', r:5}},
//                {latLng: [0, 0], name: "N/A, Heard Island and McDonald Islands", style:{fill: 'lime', r:5}},
//                {latLng: [-7.3, 72.4], name: "Diego Garcia, British Indian Ocean Territory", style:{fill: 'lime', r:5}},
//                {latLng: [0, 0], name: "N/A, Macau", style:{fill: 'lime', r:5}},

            ]
        });
        //----------------
        //- END jVector Maps -
        //----------------
    </script>

    <!-- Sparkline -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/sparkline/jquery.sparkline.min.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            //INITIALIZE SPARKLINE CHARTS
            $(".sparkline").each(function () {
                var $this = $(this);
                $this.sparkline('html', $this.data());
            });

            /* SPARKLINE DOCUMENTAION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
            drawDocSparklines();
            drawMouseSpeedDemo();

        });


        function drawDocSparklines() {

            // Bar + line composite charts
            $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
            $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                    {composite: true, fillColor: false, lineColor: 'red'});


            // Line charts taking their values from the tag
            $('.sparkline-1').sparkline();

            // Larger line charts for the docs
            $('.largeline').sparkline('html',
                    {type: 'line', height: '2.5em', width: '4em'});

            // Customized line chart
            $('#linecustom').sparkline('html',
                    {height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
                        minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3});

            // Bar charts using inline values
            $('.sparkbar').sparkline('html', {type: 'bar'});

            $('.barformat').sparkline([1, 3, 5, 3, 8], {
                type: 'bar',
                tooltipFormat: '{value:levels} - {value}',
                tooltipValueLookups: {
                    levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
                }
            });

            // Tri-state charts using inline values
            $('.sparktristate').sparkline('html', {type: 'tristate'});
            $('.sparktristatecols').sparkline('html',
                    {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

            // Composite line charts, the second using values supplied via javascript
            $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
            $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                    {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

            // Line charts with normal range marker
            $('#normalline').sparkline('html',
                    {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
            $('#normalExample').sparkline('html',
                    {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

            // Discrete charts
            $('.discrete1').sparkline('html',
                    {type: 'discrete', lineColor: 'blue', xwidth: 18});
            $('#discrete2').sparkline('html',
                    {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

            // Bullet charts
            $('.sparkbullet').sparkline('html', {type: 'bullet'});

            // Pie charts
            $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

            // Box plots
            $('.sparkboxplot').sparkline('html', {type: 'box'});
            $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
                    {type: 'box', raw: true, showOutliers: true, target: 6});

            // Box plot with specific field order
            $('.boxfieldorder').sparkline('html', {
                type: 'box',
                tooltipFormatFieldlist: ['med', 'lq', 'uq'],
                tooltipFormatFieldlistKey: 'field'
            });

            // click event demo sparkline
            $('.clickdemo').sparkline();
            $('.clickdemo').bind('sparklineClick', function (ev) {
                var sparkline = ev.sparklines[0],
                        region = sparkline.getCurrentRegionFields();
                value = region.y;
                alert("Clicked on x=" + region.x + " y=" + region.y);
            });

            // mouseover event demo sparkline
            $('.mouseoverdemo').sparkline();
            $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
                var sparkline = ev.sparklines[0],
                        region = sparkline.getCurrentRegionFields();
                value = region.y;
                $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
            }).bind('mouseleave', function () {
                $('.mouseoverregion').text('');
            });
        }



        /**
         ** Draw the little mouse speed animated graph
         ** This just attaches a handler to the mousemove event to see
         ** (roughly) how far the mouse has moved
         ** and then updates the display a couple of times a second via
         ** setTimeout()
         **/
        function drawMouseSpeedDemo() {
            var mrefreshinterval = 500; // update display every 500ms
            var lastmousex = -1;
            var lastmousey = -1;
            var lastmousetime;
            var mousetravel = 0;
            var mpoints = [];
            var mpoints_max = 30;
            $('html').mousemove(function (e) {
                var mousex = e.pageX;
                var mousey = e.pageY;
                if (lastmousex > -1) {
                    mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
                }
                lastmousex = mousex;
                lastmousey = mousey;
            });
            var mdraw = function () {
                var md = new Date();
                var timenow = md.getTime();
                if (lastmousetime && lastmousetime != timenow) {
                    var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
                    mpoints.push(pps);
                    if (mpoints.length > mpoints_max)
                        mpoints.splice(0, 1);
                    mousetravel = 0;
                    $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' requests per second'});
                }
                lastmousetime = timenow;
                setTimeout(mdraw, mrefreshinterval);
            };
            // We could use setInterval instead, but I prefer to do it this way
            setTimeout(mdraw, mrefreshinterval);
        }

    </script>
@endsection
