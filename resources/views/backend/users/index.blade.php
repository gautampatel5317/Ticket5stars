@extends('backend.layouts.admin')
@section('content')
@include('flash::message')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                {{ trans('global.add') }} {{ trans('global.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="users_table" class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
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
              {data: 'name', name:'{{ config('tables.users_table')}}.name'},
              {data: 'email', name: '{{ config('tables.users_table')}}.email'},
              {data: 'email_verified_at', name: '{{ config('tables.users_table')}}.email_verified_at'},
              {data: 'created_at', name: '{{ config('tables.users_table')}}.created_at'},
              {data: 'updated_at', name:   '{{ config('tables.users_table')}}.updated_at'},
              {data: 'actions', name: 'actions', searchable: false, sortable: false},
          ],
          // order: [[0, "asc"]],
          order: [],
          searchDelay: 500,
          dom: 'lBfrtip',
          buttons: {
              buttons: [
                  { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2,3,4,5 ]  }},
                  { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }},
                  { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }},
                  { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }},
                  { extend: 'print', className: 'printButton',  exportOptions: {columns: [  0, 1, 2,3,4,5 ]  }}
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