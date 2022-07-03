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
