@extends('backend.layouts.admin')
@section('content')
@include('flash::message')
@can('customer_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.customers.create") }}">
            {{ trans('global.add') }} {{ trans('global.customer.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.customer.title_singular') }} {{ trans('global.list') }}
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
                    {data: 'first_name', name: 'first_name' },
                    {data: 'family_name', name: 'family_name' },
                    {data: 'email', name: 'email' },
                    {data: 'experience', name: 'experience' },
                    {data: 'business', name: 'business' },
                    {data: 'status', name: 'status' },
                    {data: 'actions', name: 'actions', searchable: false, sortable: false
                    },
                ],
                order: [[0, "desc"]],
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