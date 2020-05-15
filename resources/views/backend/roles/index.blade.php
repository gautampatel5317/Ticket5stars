@extends('backend.layouts.admin')
@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header form-inline">
        {{ trans('global.role.title_singular') }} {{ trans('global.list') }}
        @can('role_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12" style="margin-left: 1400px;">
            <a class="btn btn-primary" href="{{ route("admin.roles.create") }}">
                <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('global.role.title_singular') }}
            </a>
        </div>
    </div>
@endcan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="roles_table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.role.fields.title') }}
                        </th>
                        <th>
                            {{ trans('global.role.fields.permissions') }}
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
$(function () {
     // Ajax Data Load
     $('tr > td').removeClass('select-checkbox');
      var dataTable = $('#roles_table').DataTable({
          "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
          ],
          processing: true,
          serverSide: true,
          ajax: {
              url: '{{ route("admin.roles.get") }}',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post'
          },
          columns: [
              {data: 'checkbox', name:'{{ config('tables.roles_table')}}.id',visible:false},
              {data: 'title', name:'{{ config('tables.roles_table')}}.title'},
              {data: 'permission', name: '{{ config('tables.permissions_table')}}.title'},
              {data: 'action_buttons', name: 'action_buttons', searchable: false, sortable: false},
          ],
          order: [],
          searchDelay: 500,
          dom: 'lBfrtip',
          buttons: {
              buttons: [
                  { extend: 'copy', className: 'copyButton btn btn-primary',  exportOptions: {columns: [1,2]  }},
                  { extend: 'csv', className: 'csvButton btn-primary',  exportOptions: {columns: [1,2]  }},
                  { extend: 'excel', className: 'excelButton btn-primary',  exportOptions: {columns: [1,2]  }},
                  { extend: 'pdf', className: 'pdfButton btn-primary',  exportOptions: {columns: [1,2]  }},
                  { extend: 'print', className: 'printButton btn-primary',  exportOptions: {columns: [1,2]  }}
              ]
          }
      });
  });
    /* End Ajax Load Data */
        $(document).on('click','.delete_record',function(e){
          var delId = jQuery(this).attr('data');
          var deleteUrl = window.origin+`/admin/roles/${delId}/delete`;
          console.log(deleteUrl);
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
              window.location.href = deleteUrl;
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
        });
          e.preventDefault();
      });
</script>
@endsection