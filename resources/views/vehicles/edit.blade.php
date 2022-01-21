@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('default.title_edit', ['title' => __('vehicle.title')]) }}
                    </div>

                    <div class="card-body">
                        <form  id="form-data" class="form-horizontal" action="{{ route('admin.vehicles.update', $data->id) }}" method="post">
                            <input type="hidden" name="_method" value="put" />
                            @include('vehicles.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection