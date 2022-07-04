<div class="modal fase " id="all_worker_busy" data-backdrop="static" data-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="modal-title" id="staticBackdropLabel">
                {{ __('workers') }}</h5>



            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div id="company_edit">
            <div class=" text-center ">

                <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('Image')</th>
                            <th>@lang('worker name')</th>
                            <th>@lang('number of visits')</th>
                            <th>@lang('Company Name')</th>
                            <th>@lang('Status')</th>


                        </tr>
                    </thead>
                    <tbody>
                      @if(auth()->user()->hasRole('Admin'))

                        @php
                            $companies = App\Worker::where('status',0)->orderBy('id', 'DESC')->take(10)->get();
                        @endphp
                        @else
                        @php
                            $companies = App\Worker::where('status',0)->where('copmany_id',auth()->user()->company->id)->orderBy('id', 'DESC')->take(10)->get();
                        @endphp
                        @endif


                        @foreach ($companies as $key => $worker)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><img src="{{ asset('uploads/' . $worker->image) }}"
                                  width="70" height="50" alt=""></td>
                                 <td>{{ $worker->name }}</td>
                                <td>{{ $worker->visitor_count->count() }}</td>
                                <td>{{ @$worker->company->name }}</td>
                                <td>
                                  <label style="width: 68px"
                                      class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker->status) }}</label>
                                </td>
                                  {{-- <label for="" class="btn btn-success"> --}}





                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('worker.index',['status'=>0]) }}" class="btn btn-info">
                @lang('Show All')
            </a>
        </div>

    </div>
</div>
</div>