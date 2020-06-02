@extends('backend.layouts.admin')
@section('page-header')
    {{ trans('Email Template Management') }}
@endsection
@section('content')
@include('flash::message')
<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<div class="card-tools">
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
								<table id="emailtemplate_table" class="table table-condensed table-hover table-bordered datatable">
									 <thead>
									 	<th width="10"></th>
									 	<th>{{ trans('global.email_template.tables.title') }}</th>
									 	<th>{{ trans('global.email_template.tables.subject') }}</th>
									 	<th>{{ trans('global.email_template.tables.status') }}</th>
									 	<th>{{ trans('global.email_template.tables.createdat') }}</th>
									 	<th>{{ trans('global.email_template.tables.updatedat') }}</th>
									    <th>{{ trans('Actions') }}</th>
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
<script type="text/javascript">
$(function () {
	$('tr > td').removeClass('select-checkbox');
	var dataTable = $('#emailtemplate_table').DataTable({
		"lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
          ],
          processing: true,
          serverSide: true,
          ajax: {
              url: '{{ route("admin.emailtemplates.get") }}',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post'
          },
          columns: [
              {data: 'checkbox', name:'{{ config('tables.email_templates.table')}}.id',visible:false},
              {data: 'title', name:'{{ config('tables.email_templates.table')}}.title'},
              {data: 'subject', name: '{{ config('tables.email_templates.table')}}.subject'},
               {data: 'status', name: '{{ config('tables.email_templates.table')}}.status'},
              {data: 'created_at', name: '{{ config('tables.email_templates.table')}}.created_at'},
              {data: 'updated_at', name:   '{{ config('tables.email_templates.table')}}.updated_at'},
              {data: 'actions', name: 'actions', searchable: false, sortable: false},
          ],
          order: [],
          searchDelay: 500,
          dom: 'lBfrtip',
          buttons: {
              buttons: [
                  { extend: 'copy', className: 'btn btn-primary copyButton',  exportOptions: {columns: [ 0, 1, 2,3,4]  }},
                  { extend: 'csv', className: 'btn btn-primary csvButton',  exportOptions: {columns: [  0, 1, 2,3,4]  }},
                  { extend: 'excel', className: 'btn btn-primary excelButton',  exportOptions: {columns: [  0, 1, 2,3,4]  }},
                  { extend: 'pdf', className: 'btn btn-primary pdfButton',  exportOptions: {columns: [  0, 1, 2,3,4]  }},
                  { extend: 'print', className: 'btn btn-primary printButton',  exportOptions: {columns: [  0, 1, 2,3,4]  }}
              ]
          }
	});
	 $(document).on('click','.delete_record',function(e){
          var delId = jQuery(this).attr('data');
          var deleteUrl = window.origin+`/admin/emailtemplates/${delId}/delete`;
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