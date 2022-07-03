<div class="content-body">
    <!-- Bar charts section start -->
    <section id="chartjs-bar-charts">
        <!-- Bar Chart -->

        <!-- Column Chart -->
        <div class="row">
            <div class="col-7">
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
                                } else {
                                    $dates = App\Booking::where('company_id', auth()->user()->company->id)
                                        ->where('created_at', '>=', $one_week_ago)
                                        ->groupBy('date')
                                        ->orderBy('date', 'ASC')
                                        ->get([DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as "count"')]);
                                }
                                
                                $dates_array = [];
                                $count_array = [];
                                foreach ($dates as $date) {
                                    array_push($count_array, $date->count);
                                    array_push($dates_array, $date->date);
                                }
                            @endphp
                          
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

{{-- <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/column.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/column-stacked.js') }}"
  type="text/javascript"></script>
  <script src="{{ asset('backend/js/scripts/charts/chartjs/bar/column-multi-axis.js') }}"
  type="text/javascript"></script> --}}
