<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

<div class="row mb-3 has-validation">
    <label for="name" class="col-sm-2 col-form-label">{{ __('user.name') }}</label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="name" name="name" value="{{ $data->name }}">
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-sm-2 col-form-label">{{ __('user.email') }}</label>
    <div class="col-sm-10">
        <input type="email" required class="form-control" id="email" name="email" value="{{ $data->email }}">
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-sm-2 col-form-label">{{ __('user.password') }}</label>
    <div class="col-sm-10">
        <input type="password" {{ is_null($data->id) ? 'required' : '' }} class="form-control" id="password" name="password" value="">
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ __('default.save') }}</button>


@section('script')
    <script>
        $("#form-data").validate({
            submitHandler: function(form) {
                $.ajax({
                    type: "{{ $data->id ? 'PUT' : 'POST' }}",
                    data: $("#form-data").serialize(),
                    dataType: 'json',
                    url: form.action
                })
                .done(function(res) {
                    if(res.success == true){
                        bootbox.alert(res.message, function(){ 
                            window.location = '{{ route('admin.users.index') }}';
                        });
                    }
                    else{
                        bootbox.alert(res.message);
                    }
                })
                .fail(function(res) {
                    console.info(res);
                    viewErrors(res.responseJSON);
                });
                return false;
            }
        });
    </script>
@endsection