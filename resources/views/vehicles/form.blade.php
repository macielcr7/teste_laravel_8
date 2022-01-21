<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

<div class="row mb-3">
    <label for="plate" class="col-sm-2 col-form-label">{{ __('vehicle.plate') }}</label>
    <div class="col-sm-10">
        <input type="text" required class="form-control text-uppercase" maxlength="7" id="plate" name="plate" value="{{ $data->plate }}">
    </div>
</div>

<div class="row mb-3">
    <label for="model" class="col-sm-2 col-form-label">{{ __('vehicle.model') }}</label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="model" name="model" value="{{ $data->model }}">
    </div>
</div>

<div class="row mb-3">
    <label for="color" class="col-sm-2 col-form-label">{{ __('vehicle.color') }}</label>
    <div class="col-sm-10">
        <input type="text" required class="form-control" id="color" name="color" value="{{ $data->color }}">
    </div>
</div>

<div class="row mb-3">
    <label for="type" class="col-sm-2 col-form-label">{{ __('vehicle.type') }}</label>
    <div class="col-sm-10">
        <select required class="form-select" id="type" name="type">
            <option value="">{{ __('default.select_one_item') }}</option>
            <option {{ $data->type == 'car' ? 'selected' : '' }} value="car">{{ __('vehicle.types.car') }}</option>
            <option {{ $data->type == 'motorcycle' ? 'selected' : '' }} value="motorcycle">{{ __('vehicle.types.motorcycle') }}</option>
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary">{{ __('default.save') }}</button>


@section('script')
    <script>
        $('#plate').on('keyup', function() {
            this.value = this.value.toUpperCase();
        });
        jQuery.validator.addMethod('plate', function (value, element) {
            return this.optional(element) || /^[A-Z]{3}[0-9][0-9A-Z][0-9]{2}$/.test(value);
        }, '{{ __('vehicle.plate_validation') }}');

        $("#form-data").validate({
            rules: {
                plate: {
                    required: true,
                    plate: true,
                },
            },

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
                            window.location = '{{ route('admin.vehicles.index') }}';
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