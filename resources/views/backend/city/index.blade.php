@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.city_management') }}
@endsection
@section('content')
@include('flash::message')

<div class="container-fluid">
<div class="card card-primary card-outline">

    <div class="card-header">
        <div class="card-tools">
        @can('city_create')
            <a class="btn btn-primary btn-sm" href="{{ route("admin.city.create") }}">
            <i class="mr-1 fas fa-plus"></i>{{ trans('global.add') }} {{ trans('global.city.title_singular') }}
            </a>
          @endcan
        </div>
     </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="city_table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            {{ trans('global.city.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.country_name') }}
                        </th>
                        <th>
                            {{ trans('global.state_name') }}
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
            var dataTable = $('#city_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.city.get") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: {status:status}
                },
                columns: [
                    {data: 'name', name: 'name' },
                    {data: 'country_name', name: 'country_name' },
                    {data: 'state_name', name: 'state_name' },
                    {data: 'status', name: 'status' },
                    {data: 'actions', name: 'actions', searchable: false, sortable: false },
                ],
                order: [],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [{
                            extend: 'copy',
                            className: 'copyButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'csv',
                            className: 'csvButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'excelButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdf',
                            className: 'pdfButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'print',
                            className: 'printButton',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
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
                        url: "{{URL('admin/city/')}}"+"/"+delId,
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
                                $('#city_table').DataTable().ajax.reload();
                                    Swal.fire(
                                    'Deleted!',
                                    'City has been deleted.',
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

        $(document).on('click','.change_status',function(e){
            var ID = jQuery(this).attr('data');
            var status = $(this).prop('checked') == true ? 1 : 0;
            $.ajax({
                url: "{{URL('admin/city/changeStatus')}}",
                type: "POST",
                cache: false,
                data:{
                    _token:'{{ csrf_token() }}', 
                    'status': status, 
                    'id': ID
                },
                success: function(dataResult){
                    if(dataResult=="success"){
                        $('#city_table').DataTable().ajax.reload();
                        Swal.fire(
                        'Done!',
                        'Status has been updated successfully.',
                        'success'
                        );
                    }else{
                        swal("Error!", "Something Went Wrong!", "error");
                    }
                }
            });
        });

    })
    
</script>
@endsection