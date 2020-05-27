@extends('backend.layouts.admin')
@section('page-header')
{{ trans('Permissions Management') }}
@endsection
@section('content')
<div class="container-fluid">
     @include('flash::message')
     <div class="card card-primary card-outline">
          <div class="card-header">
              <div class="card-tools">
                @can('permission_create')
                   <a href="{{route('admin.permissions.create')}}" class="btn btn-primary btn-sm"><i class="mr-1 fas fa-plus"></i>Add New Permission</a>
                @endcan
              </div>
          </div>
          <div class="card-body">
               <div class="table-responsive">
                  <table id="permission_table" class=" table table-bordered table-striped table-hover datatable">
                      <thead>
                          <tr>
                              <th width="10">
                              </th>
                              <th>
                                  {{ trans('global.permission.fields.title') }}
                              </th>
                              <th>
                                {{ trans('Action') }}
                              </th>
                          </tr>
                      </thead>
                        <tbody>
                        </tbody>
                    </table>
               </div>
          </div>
     </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(function () {
  var dataTable = $('#permission_table').DataTable({
    "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
          ],
      processing: true,
      serverSide: true,
      ajax: {
              url: '{{ route("admin.permissions.get") }}',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post'
      },
      columns: [
              {data: 'checkbox', name:'{{ config('tables.permissions_table')}}.id',visible:false},
              {data: 'title', name:'{{ config('tables.permissions_table')}}.title'},
              {data: 'action_buttons', name: 'actions', searchable: false, sortable: false},
          ],
       order: [],
       searchDelay: 500,
       dom: 'lBfrtip',
       buttons: {
            buttons: [
                { extend: 'copy', className: 'btn btn-primary copyButton',  exportOptions: {columns: [1]  }},
                { extend: 'csv', className: 'btn btn-primary csvButton',  exportOptions: {columns: [1]  }},
                { extend: 'excel', className: 'btn btn-primary excelButton',  exportOptions: {columns: [1]  }},
                { extend: 'pdf', className: 'btn btn-primary pdfButton',  exportOptions: {columns: [1]  }},
                { extend: 'print', className: 'btn btn-primary printButton',  exportOptions: {columns: [1]  }}
            ]
        }
  });

      $(document).on('click','.delete_record',function(e){
          var delId = jQuery(this).attr('data');
          console.log(delId);
          var deleteUrl = window.origin+`/admin/permissions/${delId}/delete`;
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

});
</script>
@endsection