@extends('layouts.backend')
@section('content')
<div class="content-body">
    <section id="configuration">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
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

<div class="card-body card-dashboard">
            <h2 class="mb-3"> ترجمة الملف باللغة {{ $language }}</h2>
        <form class="form-horizontal" action="{{ route('languages.key_value_store',app()->getLocale()) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $language }}">
            <table class="table table-striped table-bordered zero-configuration" id="kt_datatable">

            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Key')}}</th>
                    <th>{{__('Value')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach (openJSONFile('en') as $key => $value)
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="key">{{ $key }}</td>
                        <td>
                            <input type="text" class="form-control value" style="width:100%" name="key[{{ $key }}]" @isset(openJSONFile($language)[$key])
                                value="{{ openJSONFile($language)[$key] }}"
                            @endisset>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
 
        </table>
        <div class="panel-footer text-right">
            <button type="button" class="btn btn-warning" onclick="copyTranslation()">{{ __('Copy Translations') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>

    </div>
</div>

@endsection



@section('script')
{{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> --}}
<script type="text/javascript">
$(document).ready(function() {
    $('table').DataTable();
} );
    function copyTranslation() {
        $('#kt_datatable > tbody  > tr').each(function (index, tr) {
            $(tr).find('.value').val($(tr).find('.key').text());
        });
    }

</script>

@endsection