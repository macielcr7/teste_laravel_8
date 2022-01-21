@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('vehicle.title') }}
                    <span style="float:right">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group" style="margin-right:10px;">
                            <input type="radio" class="btn-check" name="btnradio" value="{{ auth()->user()->id }}" id="btnradio1" autocomplete="off">
                            <label class="btn btn-sm btn-outline-primary" for="btnradio1">{{ __('default.my_vehicles') }}</label>

                            <input type="radio" class="btn-check" name="btnradio" value="" id="btnradio2" autocomplete="off" checked>
                            <label class="btn btn-sm btn-outline-primary" for="btnradio2">{{ __('default.all_vehicles') }}</label>
                        </div>
                        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-sm">{{ __('default.add') }}</a>
                    </span>
                </div>
                

                <div class="card-body">
                    <table id="table-data" class="table table-hover table-bordered" style="width:100%!important">
                        <thead>
                            <tr>
                                <th>{{ __('vehicle.id') }}</th>
                                <th>{{ __('vehicle.plate') }}</th>
                                <th>{{ __('vehicle.model') }}</th>
                                <th>{{ __('vehicle.color') }}</th>
                                <th>{{ __('vehicle.type') }}</th>
                                <th>{{ __('default.action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        window.__table = $('#table-data').DataTable({
            "ajax": {
                "ajax": "{{ route('admin.vehicles.index') }}",
                "data": function (d) {
                    d.user_id = ''+$('input[name="btnradio"]:checked').val();
                }
            },

            "responsive": true,
            "processing": true,
            "serverSide": true,

            "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
            "pageLength": 25,

            "order": [[ 1, "asc" ]],
            "columns": [
                { "data": "id" },
                { "data": "plate" },
                { "data": "model" },
                { "data": "color" },
                { "data": "type" },
                { "data": "created_at", className: "menu-action" }
            ],
            "aoColumnDefs":[
                {
                    "aTargets": [ 5 ],
                    "bSortable": false,
                    "mRender": function ( data, type, full )  {
                        if(window.__USER_ID == full.user_id){
                            return  '<a href="'+__URL_BASE+'/admin/vehicles/'+full.id+'/edit" class="btn btn-primary btn-sm" style="margin-right:10px;">{{ __('default.edit') }}</a>'+
                                    '<a href="'+__URL_BASE+'/admin/vehicles/'+full.id+'" class="btn btn-danger btn-sm btn-remove">{{ __('default.delete') }}</a>';
                        }
                        else{
                            return '';
                        }
                    }
                }
            ]
        });

        $('input[name=btnradio]').change(function(e){
            window.__table.ajax.reload();
        });

        $('body').on('click', '.btn-remove', function(e){
            e.preventDefault();
            var link = $(this);
            
            bootbox.confirm('{{ __('default.confirm_delete') }}?', function(result){ 
                if(result){
                    $.ajax({
                        type: "DELETE",
                        data: {
                            _token: $('#_token').val()
                        },
                        dataType: 'json',
                        url: link.attr('href'),
                        success: function(o) {
                            if(o.success==true){
                                window.__table.ajax.reload();
                                bootbox.alert(o.message);
                            }
                            else{
                                bootbox.alert(o.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
