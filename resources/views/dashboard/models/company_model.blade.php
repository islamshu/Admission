<div class="modal fase " id="all_company" data-backdrop="static" data-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="modal-title" id="staticBackdropLabel">
                {{ __('Companies') }}</h5>



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
                            <th>@lang('Company Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Phone')</th>
                            <th>@lang('Is verify')</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $companies = App\Company::orderBy('id', 'DESC')->take(10)->get();
                        @endphp

                        @foreach ($companies as $key => $company)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>
                                    @if (@$company->user->verify == 1)
                                        <label class="badge badge-success">@lang('Verify')</label>
                                    @else
                                        <label class="badge badge-danger">@lang('Not Verify') </label>
                                    @endif

                                </td>





                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('companies.index') }}" class="btn btn-info">
                @lang('Show All')
            </a>
        </div>

    </div>
</div>
</div>