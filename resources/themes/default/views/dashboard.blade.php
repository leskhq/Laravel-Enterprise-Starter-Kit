@extends('layouts.master')

@section('head_extra')
    <!-- jVectorMap 1.2.2 -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">New Customers</span>
                    <span class="info-box-number">{{ $newCustomersCount }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-bar-chart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">{{ $salesThisMonthCount }}</span>
                </div>
            </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Income Online</span>
                    <span class="info-box-number">{{ Helpers::reggo($incomeThisMountTotal) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-smile-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">BO Goal</span>
                    <span class="info-box-number">2</span>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-4 col-md-offset-8'>
            <!-- BROWSER USAGE -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Income Detail</h3>
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
                                @foreach($saleDetails as $detail => $item)
                                <li><i class="fa fa-circle-o text-{{ $item['color'] }}"></i> {{ $detail }}</li>
                                @endforeach
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($saleDetailsLastMonth as $detail => $item)
                        <li>
                            <a href="#">{{ $item['label'] }}
                                <span class="pull-right text-{{ $item['valueThisMonth'] > $item['value'] ? 'green' : 'red' }}">
                                    <i class="fa fa-angle-{{ $item['valueThisMonth'] > $item['value'] ? 'up' : 'down' }}"></i>
                                    {{ Helpers::reggo($item['valueThisMonth']-$item['value']) }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div><!-- /.footer -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection


@section('body_bottom')
    <!-- ChartJS -->
    <script src="{{ asset ("/bower_components/admin-lte/plugins/chartjs/Chart.min.js") }}" type="text/javascript"></script>

    <script type="text/javascript">
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            @foreach($saleDetails as $detail => $item)
            {
                value    :  {{ $item['value'] }},
                color    : '{{ $item['color'] }}',
                highlight: '{{ $item['highlight'] }}',
                label    : '{{ $item['label'] }}'
            },
            @endforeach
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
            tooltipTemplate: "<%=value%> income <%=label%>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
        //-----------------
        //- END PIE CHART -
        //-----------------
    </script>
@endsection
