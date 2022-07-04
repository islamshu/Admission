
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('Bookings within the last 7 days')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                   
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                           
                          
                            <canvas id="column-chart" height="400"></canvas>
                        </div>
                    </div>
                </div>
         
    <!-- // Bar charts section end -->
</div>
<script src="{{ asset('backend/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar-stacked.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar-multi-axis.js') }}" type="text/javascript"></script>
    @php
        $one_week_ago = \Carbon\Carbon::now()
            ->subDays(6)
            ->format('Y-m-d');
        if (
            auth()
                ->user()
                ->hasRole('Admin')
        ) {
            $dates = App\Booking::where('created_at', '>=', $one_week_ago)
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get([DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as "count"')]);
                $visitor = App\Vistor::where('created_at', '>=', $one_week_ago)
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get([DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as "count"')]);
        } else {
            $dates = App\Booking::where('company_id', auth()->user()->company->id)
                ->where('created_at', '>=', $one_week_ago)
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get([DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as "count"')]);
                $visitor = App\Vistor::where('company_id', auth()->user()->company->id)->where('created_at', '>=', $one_week_ago)
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get([DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as "count"')]);
        }
       
        
        $dates_array = [];
        $count_array = [];
        $visitor_array = [];
        foreach ($dates as $date) {
            array_push($count_array, $date->count);
            array_push($dates_array, $date->date);
        }
        foreach ($visitor as $date) {
            array_push($visitor_array, $date->count);
        }
    @endphp
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
        display: true,
        text: 'Chart.js Bar Chart'
    }
};

// Chart Data
var chartData = {
    labels: {!! json_encode($dates_array) !!},
    datasets: [{
        label: "My First dataset",
        data: {!! json_encode($count_array) !!},
        backgroundColor: "#28D094",
        hoverBackgroundColor: "rgba(22,211,154,.9)",
        borderColor: "transparent"
    }, {
        label: "My Second dataset",
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
