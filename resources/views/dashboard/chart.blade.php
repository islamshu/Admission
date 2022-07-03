<div class="content-body">
    <!-- Bar charts section start -->
    <section id="chartjs-bar-charts">
      <!-- Bar Chart -->
   
      <!-- Column Chart -->
      <div class="row">
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">@lang('Bookings within the last 7 days')</h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body">
                @php
                    $one_week_ago = \Carbon\Carbon::now()->subDays(6)->format('Y-m-d');
                $dates = App\Booking::where('created_at', '>=', $one_week_ago)
                        ->groupBy('date')
                        ->orderBy('date', 'ASC')
                        ->get(array(
                            DB::raw('Date(created_at) as date'),
                            DB::raw('COUNT(*) as "count"')
                        ));

                        $dates_array = array();
                        $count_array = array();
                        foreach ($dates as $date) {
                            array_push($count_array,$date->count);
                            array_push($dates_array,$date->date);

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
        display: false,
        text: 'Chart.js Bar Chart'
    }
};

// Chart Data

var chartData = {
    labels: {!! json_encode($dates_array) !!},
    datasets: [{
        label: "@lang('Booking')",
        data: {{ json_encode($count_array) }},
        backgroundColor: "#28D094",
        hoverBackgroundColor: "rgba(22,211,154,.9)",
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
                <canvas id="column-chart" height="400"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Bar Stacked Chart -->
  
    </section>
    <!-- // Bar charts section end -->
  </div>
  <script src="{{ asset('backend/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{ asset('backend/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{ asset('backend/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar-stacked.js') }}" type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/bar-multi-axis.js') }}"
  type="text/javascript"></script>
  {{-- <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/column.js') }}" type="text/javascript"></script> --}}
  {{-- <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/column-stacked.js') }}"
  type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/column-multi-axis.js') }}"
  type="text/javascript"></script> --}}