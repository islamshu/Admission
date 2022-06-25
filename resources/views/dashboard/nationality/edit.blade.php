<form action="{{ route('nationalities.update',$nat->id) }}" method="post">
    @csrf
    @method('put')
    <div class="modal-body mx-3">
        <div class="md-form mb-2">
         <label data-error="wrong" data-success="right" for="form3">Arabic Name</label>
         <input type="text" id="form3" name="name_ar" value="{{ $nat->getTranslation('name', 'ar') }}" class="form-control validate">
        </div>

        <div class="md-form mb-2">
         <label data-error="wrong" data-success="right" for="form2">English Name</label>
         <input type="text" id="form2" name="name_en" value="{{ $nat->getTranslation('name', 'en') }}" class="form-control validate">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-info" type="submit">Send </i></button>
      </div>
</form>