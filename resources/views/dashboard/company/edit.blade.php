<div id="form-errors" class="text-center" ></div>
<div id="success" class="text-center" ></div>





<form id="sendmemessage" >
    @csrf

    <div class="modal-body mx-3">
        <div class="row">
            <div class="col-md-6">
                <label data-error="wrong" data-success="right" for="form3">@lang('Company Name')</label>
                <input type="text" id="form3" name="name" required value="{{ $company->name }}"
                    class="form-control validate">
            </div>

            <div class="col-md-6">
                <label data-error="wrong" data-success="right" for="form2">@lang('Email')</label>
                <input type="email" id="form2" name="email" required value="{{ $company->email }}"
                    class="form-control validate">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label data-error="wrong" data-success="right" for="form3">@lang('Phone')</label>
                <input type="text" id="form3" name="phone" required value="{{ $company->phone }}"
                    class="form-control validate">
            </div>

            <div class="col-md-6">
                <label data-error="wrong" data-success="right" for="form2">@lang('Commical Register')</label>
                <input type="text" id="form2" name="commercial_register" required value="{{ $company->co_register }}"
                    class="form-control validate">
            </div>
            
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label data-error="wrong" data-success="right" for="form2">@lang('Password')</label>
                <input type="password" id="form2" name="password"  value=""
                    class="form-control validate">
            </div>
            
        </div>
        

    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info" type="submit">@lang('save') </i></button>
      </div>
</form>
<script>
$('#sendmemessage').on('submit', function(e) {
        e.preventDefault();
  
        var data = $(this).serialize();

        $.ajax({
            url: "{{ route('companies.update',$company->id) }}",
            type: "put",
            data : data,
            success: function(data) {
                var response = data.success;
                success = '<div class="alert alert-success">';
                success += '<div>'+response+'</div></div>';
                $( '#success' ).html( success );
            
            },
            error: function(data) {
                var errors = data.responseJSON;
                    var errors = data.responseJSON;
                   errorsHtml = '<div class="alert alert-danger"><ul>';
                  $.each(errors.errors,function (k,v) {
                         errorsHtml += '<li>'+ v + '</li>';
                  });
                  errorsHtml += '</ul></di>';
                  $( '#form-errors' ).html( errorsHtml );
            },
        });
    });
</script>
