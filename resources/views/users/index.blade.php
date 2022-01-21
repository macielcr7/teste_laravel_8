@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('user.title') }}
                    <span style="float:right">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">{{ __('default.add') }}</a>
                    </span>
                </div>
                

                <div class="card-body">
                    <table id="table-data" class="table table-hover table-bordered" style="width:100%!important">
                        <thead>
                            <tr>
                                <th>{{ __('user.id') }}</th>
                                <th>{{ __('user.name') }}</th>
                                <th>{{ __('user.email') }}</th>
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
                "ajax": "{{ route('admin.users.index') }}"
            },

            "responsive": true,
            "processing": true,
            "serverSide": true,

            "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
            "pageLength": 25,

            "order": [[ 1, "asc" ]],
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "created_at", className: "menu-action" }
            ],
            "aoColumnDefs":[
                {
                    "aTargets": [ 3 ],
                    "bSortable": false,
                    "mRender": function ( data, type, full )  {
                        return  '<a href="'+__URL_BASE+'/admin/users/'+full.id+'/edit" class="btn btn-primary btn-sm" style="margin-right:10px;">{{ __('default.edit') }}</a>'+
                                '<a href="'+__URL_BASE+'/admin/users/'+full.id+'" class="btn btn-danger btn-sm btn-remove">{{ __('default.delete') }}</a>';
                    }
                }
            ]
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
