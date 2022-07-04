
            <div class="col-12" >
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="display: contents">@lang('Bookings within the last '){{ $day }} @lang('days')</h4>
                        <form action="" style="display: inline">
                            <select  id="day_chart" name="day" class="form-control " style="width: 10%;display: revert;">
                                <option value="7" @if($day == 7) selected @endif>7</option>
                                <option value="14" @if($day == 14) selected @endif>14</option>
                                <option value="30" @if($day == 30) selected @endif>30</option>
                            </select>
                            <input type="submit" class="btn" value="@lang('send')">
                        </form>
                       


                   
                    </div>
                    <div class="card-content collapse show">
                       
                        <div class="card-body">
                    <canvas id="column-chart" class="replace"  height="400"></canvas>
                    </div>
                    </div>
                    
                </div>
         
    <!-- // Bar charts section end -->
</div>
<script src="{{ asset('backend/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar-stacked.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar-multi-axis.js') }}" type="text/javascript"></script>

<script>
    $(window).on("load", function(){

//Get the context of the Chart canvas element we want to select
var ctx = $("#column-chart");

// Chart Options
var chartOptions = {
// Elements options apply to all of the options unless overridden in a dataset
// In this case, we are setting the border of each bar to be 2px wide and green
elements: {
    rectangle: {
        borderWidth: 2,
        borderColor: 'rgb(0, 255, 0)',
        borderSkipped: 'bottom'
    }
},
responsive: true,
maintainAspectRatio: false,
responsiveAnimationDuration:500,
legend: {
    position: 'top',
},
scales: {
    xAxes: [{
        display: true,
        gridLines: {
            color: "#f3f3f3",
            drawTicks: false,
        },
        scaleLabel: {
            display: true,
        }
    }],
    yAxes: [{
        display: true,
        gridLines: {
            color: "#f3f3f3",
            drawTicks: false,
        },
        scaleLabel: {
            display: true,
        }
    }]
},
title: {
    display: false,
    text: 'Chart.js Bar Chart'
}
};

// Chart Data
var chartData = {
labels: {!! json_encode($dates_array) !!},
datasets: [{
    label: "@lang('Booking')",
    data: {!! json_encode($count_array) !!},
    backgroundColor: "#28D094",
    hoverBackgroundColor: "rgba(22,211,154,.9)",
    borderColor: "transparent"
}, {
    label: "@lang('Visitor')",
    data: {!! json_encode($visitor_array) !!},
    backgroundColor: "#F98E76",
    hoverBackgroundColor: "rgba(249,142,118,.9)",
    borderColor: "transparent"
}]
};

var config = {
type: 'bar',

// Chart Options
options : chartOptions,

data : chartData
};

// Create the chart
var lineChart = new Chart(ctx, config);
});
</script>
   