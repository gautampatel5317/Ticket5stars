@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.add') }} {{ trans('global.country.title_singular') }}
@endsection
@section('content')
@include('flash::message')

<div class="container-fluid">
<div class="card card-primary card-outline">

    <div class="card-header">
        <div class="card-tools">
        @can('country_create')
            <a class="btn btn-primary btn-sm" href="{{ route("admin.country.create") }}">
            <i class="mr-1 fas fa-plus"></i>{{ trans('global.add') }} {{ trans('global.country.title_singular') }}
            </a>
          @endcan
        </div>
     </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="country_table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                      
                        <th>
                            {{ trans('global.country.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.country.fields.code') }}
                        </th>
                        <th>
                            {{ trans('global.country.fields.phonecode') }}
                        </th>
                        <th>
                            {{ trans('global.status') }}
                        </th>
                        <th>
                            {{ trans('Actions') }}
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function() {

        fetch_data();
        function fetch_data(status = ''){
            // Ajax Data Load
            //$('tr > td').removeClass('select-checkbox');
            
            var dataTable = $('#country_table').DataTable({
                
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.country.get") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: {status:status}
                },
                columns: [
                    {data: 'name', name: 'name' },
                    {data: 'code', name: 'code' },
                    {data: 'phonecode', name: 'phonecode' },
                    {data: 'status', name: 'status' },
                    {data: 'actions', name: 'actions', searchable: false, sortable: false
                    },
                ],
                order: [],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [{
                            extend: 'copy',
                            className: 'copyButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csv',
                            className: 'csvButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'excelButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdf',
                            className: 'pdfButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'printButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        }
                    ]
                }
            });
            /* End Ajax Load Data */
        }
        
        $(document).on('click','.delete_record',function(e){
            var delId = jQuery(this).attr('data');
            var that = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{URL('admin/country/')}}"+"/"+delId,
                        type: "POST",
                        cache: false,
                        data:{
                            _token:'{{ csrf_token() }}', _method:"DELETE"
                        },
                        beforeSend:function(){
                            $(that).html('Deleting...');
                        },
                        success: function(dataResult){
                            if(dataResult=="success"){
                                setTimeout(function(){
                                $('#country_table').DataTable().ajax.reload();
                                    Swal.fire(
                                    'Deleted!',
                                    'country has been deleted.',
                                    'success'
                                    )
                                }, 1000);
                            }else{
                                swal("Error!", "Something Went Wrong!", "error");
                            }
                        }
                    });
                }
            });
            e.preventDefault();
        });

    })
    
</script>
@endsection