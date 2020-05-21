@extends('backend.layouts.admin')
@section('page-header')
    {{ trans('User Management') }}
@endsection
@section('content')
@include('flash::message')
<div class="container-fluid">
   <div class="card card-primary card-outline">
     <div class="card-header">
        <div class="card-tools">
          @can('user_create')
          <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-sm"><i class="mr-1 fas fa-plus"></i>Add New User</a>
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
                        <table id="users_table" class="table table-condensed table-hover table-bordered datatable">
                        <thead>
                            <tr>
                              <th width="10">

                                </th>
                                <th>
                                    {{ trans('global.user.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('global.user.fields.email') }}
                                </th>
                                <th>
                                    {{ trans('global.user.fields.email_verified_at') }}
                                </th>
                                <th>
                                    {{ trans('global.user.fields.roles') }}
                                </th>
                                <th>
                                    {{ trans('Created At') }}
                                </th>
                                <th>
                                    {{ trans('Updated At') }}
                                </th>
                                <th>
                                   {{ trans('Actions') }}
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
         </div>
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
      var dataTable = $('#users_table').DataTable({
          "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
          ],
          processing: true,
          serverSide: true,
          ajax: {
              url: '{{ route("admin.users.get") }}',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post'
          },
          columns: [
              {data: 'checkbox', name:'{{ config('tables.users_table')}}.id',visible:false},
              {data: 'name', name:'{{ config('tables.users_table')}}.name'},
              {data: 'email', name: '{{ config('tables.users_table')}}.email'},
              {data: 'email_verified_at', name: '{{ config('tables.users_table')}}.email_verified_at'},
               {data: 'roles', name: '{{ config('tables.roles_table')}}.title'},
              {data: 'created_at', name: '{{ config('tables.users_table')}}.created_at'},
              {data: 'updated_at', name:   '{{ config('tables.users_table')}}.updated_at'},
              {data: 'actions', name: 'actions', searchable: false, sortable: false},
          ],
          order: [],
          searchDelay: 500,
          dom: 'lBfrtip',
          buttons: {
              buttons: [
                  { extend: 'copy', className: 'btn btn-primary copyButton',  exportOptions: {columns: [ 0, 1, 2,3,4,5 ]  }},
                  { extend: 'csv', className: 'btn btn-primary csvButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }},
                  { extend: 'excel', className: 'btn btn-primary excelButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }},
                  { extend: 'pdf', className: 'btn btn-primary pdfButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }},
                  { extend: 'print', className: 'btn btn-primary printButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }}
              ]
          }
      });
      /* End Ajax Load Data */
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')
        return
      }
      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  dtButtons.push(deleteButton)
@endcan
  // $  ('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $(document).on('click','.delete_record',function(e){
          var delId = jQuery(this).attr('data');
          console.log(delId);
          var deleteUrl = window.origin+`/admin/users/${delId}/delete`;
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