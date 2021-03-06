@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.experience_management') }}
@endsection
@section('content')
@include('flash::message')

<div class="container-fluid">
    <div class="card card-primary card-outline">

        <div class="card-header">
            <div class="card-tools">
                @can('experience_create')
                <a class="btn btn-primary btn-sm" href="{{ route("admin.experience.create") }}">
                    <i class="mr-1 fas fa-plus"></i>{{ trans('global.add') }} {{ trans('global.experience.title_singular') }}
                </a>
                @endcan
            </div>
        </div>

        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box-body">
                            <div class="table-responsive-lg data-table-wrapper">
                                <table id="experience_table" class="table  table-hover table-bordered datatable cell-border">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('global.experience.fields.name') }}</th>
                                            <th>{{ trans('global.status') }}</th>
                                            <th>{{ trans('global.created_at') }}</th>
                                            <th>{{ trans('global.updated_at') }}</th>
                                            <th>{{ trans('global.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th><input type="text" class="form-control text-search" name="name" data-column="0" placeholder="{{ trans('global.experience.fields.name') }}"></th>
                                            <th>
                                                <select class="form-control select2 select-filter" name="status" data-column="1">
                                                    <option value="All">{{ trans('global.all')}}</option>
                                                    <option value="1">{{ trans('global.active')}}</option>
                                                    <option value="0">{{ trans('global.inactive')}}</option>
                                                </select>
                                            </th>
                                            <th>
                                                <input type="date" name="created_at" data-column="2" value="" class="form-control text-search">
                                            </th>
                                            <th>
                                                <input type="date" name="updated_at" data-column="3" value="" class="form-control text-search">
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function() {

        // Ajax Data Load
        var dataTable = $('#experience_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.experience.get") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: {
                    status: status
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    sortable: false
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
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'csvButton',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'excelButton',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'pdfButton',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'printButton',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }
                ]
            }
        });
        /* End Ajax Load Data */

        /* DataTable column search */
        $('.custom-select').select2({width:50});
        $('.text-search').on('keyup change',function(){
            dataTable.columns($(this).attr('data-column')).search(this.value).draw();
        });
        /* End DataTable column search */

        $('.select-filter' ).on('change',function () {
            if ($(this).val() != 'All') {
                var search_string = '';
                if($(this).val() == "1"){
                    search_string = '<span class="badge badge-success">Active</span>';
                }else{
                    search_string = '<span class="badge badge-danger">Inactive</span>';
                }
                dataTable.columns($(this).attr('data-column')).search(search_string).draw();
            } else {
                location.reload();
            }
        });
         
        $(document).on('click', '.delete_record', function(e) {
            var delId = jQuery(this).attr('data');
            var that = this;
            Swal.fire({
                title: '{{ trans("global.areYouSure")}}',
                text: '{{ trans("global.youWontbeAbletoDelete") }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ trans('global.yesDeleteIt') }}"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{URL('admin/experience/')}}" + "/" + delId,
                        type: "POST",
                        cache: false,
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: "DELETE"
                        },
                        beforeSend: function() {
                            $(that).html('{{ trans("global.deleting") }}');
                        },
                        success: function(dataResult) {
                            if (dataResult == "success") {
                                setTimeout(function() {
                                    $('#experience_table').DataTable().ajax.reload();
                                    Swal.fire(
                                        '{{ trans("global.deleted") }}',
                                        '{{ trans("global.data_has_been_deleted") }}',
                                        'success'
                                    )
                                }, 1000);
                            } else {
                                swal("{{ trans('global.error') }}", "{{ trans('global.something_Went_wrong') }}", "error");
                            }
                        }
                    });
                }
            });
            e.preventDefault();
        });

        $(document).on('click', '.change_status', function(e) {
            var ID = jQuery(this).attr('data');
            var status = $(this).prop('checked') == true ? 1 : 0;
            $.ajax({
                url: "{{URL('admin/experience/changeStatus')}}",
                type: "POST",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    'status': status,
                    'id': ID
                },
                success: function(dataResult) {
                    if (dataResult == "success") {
                        $('#experience_table').DataTable().ajax.reload();
                        Swal.fire(
                            '{{ trans("global.done") }}',
                            '{{ trans("global.status_updated_success") }}',
                            'success'
                        );
                    } else {
                        swal("{{ trans('global.error') }}", "{{ trans('global.something_Went_wrong') }}", "error");
                    }
                }
            });
        });

    })
</script>
@endsection