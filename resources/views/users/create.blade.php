@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('default.title_add', ['title' => __('user.title')]) }}
                    </div>

                    <div class="card-body">
                        <form id="form-data" class="form-horizontal" action="{{ route('admin.users.store') }}" method="post">
                            @include('users.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
