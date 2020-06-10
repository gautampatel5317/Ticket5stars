@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.add') }} {{ trans('global.customer.title_singular') }}
@endsection
@section('content')
@include('flash::message')

<div class="container-fluid">
<div class="card card-primary card-outline">

    <div class="card-header">
        <div class="card-tools">
        @can('customer_create')
            <a class="btn btn-primary btn-sm" href="{{ route("admin.customers.create") }}">
            <i class="mr-1 fas fa-plus"></i>{{ trans('global.add') }} {{ trans('global.customer.title_singular') }}
            </a>
          @endcan
        </div>
     </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="customers_table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>

                        <th>
                            {{ trans('global.customer.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.family_name') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.experience') }}
                        </th>
                        <th>
                            {{ trans('global.customer.fields.business') }}
                        </th>
                        <th>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{ trans('global.select_status')}}</option>
                                <option value="1">{{ trans('global.active')}}</option>
                                <option value="0">{{ trans('global.inactive')}}</option>
                            </select>
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

            var dataTable = $('#customers_table').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.customers.get") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: {status:status}
                },
                columns: [
                    {data: 'name', name:'{{ config('tables.users_table')}}.name'},
                    {data: 'family_name', name: 'family_name' },
                    {data: 'email',  name:'{{ config('tables.users_table')}}.email'},
                    {data: 'experience', name:'{{ config('tables.customers_table')}}.experience'},
                    {data: 'business', name:'{{ config('tables.customers_table')}}.business'},
                    {data: 'status',  name:'{{ config('tables.customers_table')}}.status' },
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

        let deleteButtonTrans = '{{ trans('global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.customers.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected ') }}')
                    return
                }

                if (confirm('{{ trans('global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': '{{ csrf_token() }}'
                            },
                            method: 'POST',
                            //type: "DELETE",
                            url: config.url,
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('customer_delete')
        dtButtons.push(deleteButton)
        @endcan

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
                        url: "{{URL('admin/customers/')}}"+"/"+delId,
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
                                $('#customers_table').DataTable().ajax.reload();
                                    Swal.fire(
                                    'Deleted!',
                                    'Customer has been deleted.',
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

        $('#status').change(function(){
            var status = $('#status').val();
            $('#customers_table').DataTable().destroy();
            fetch_data(status);
        });

    })

</script>
@endsection