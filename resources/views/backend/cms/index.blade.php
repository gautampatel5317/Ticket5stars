@extends('backend.layouts.admin')
@section('page-header')
    {{ trans('Page Management') }}
@endsection
@section('content')
@include('flash::message')

<div class="container-fluid">
   <div class="card card-primary card-outline">
     <div class="card-header">
        <div class="card-tools">
          @can('cms_create')
          <a href="{{route('admin.cms.create')}}" class="btn btn-primary btn-sm"><i class="mr-1 fas fa-plus"></i>Add New Page</a>
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
                        <table id="cms_table" class="table table-condensed table-hover table-bordered datatable">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('global.title') }}
                                </th>
                                <th>
                                    {{ trans('global.cms.fields.seo_title') }}
                                </th>
                                <th>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">{{ trans('global.select_status')}}</option>
                                        <option value="1">{{ trans('global.active')}}</option>
                                        <option value="0">{{ trans('global.inactive')}}</option>
                                    </select>
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
    
    fetch_data();
    function fetch_data(status = ''){

      var dataTable = $('#cms_table').DataTable({
          "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
          ],
          processing: true,
          serverSide: true,
          ajax: {
              url: '{{ route("admin.cms.get") }}',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'post',
              data: {status:status}
          },
          columns: [
            {data: 'title', name: 'title' },
            {data: 'seo_title', name: 'seo_title' },
            {data: 'status', name: 'status' },
            {data: 'created_at', name: 'created_at' },
            {data: 'updated_at', name: 'updated_at' },
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
    }
      /* End Ajax Load Data */
 
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
                    url: "{{URL('admin/cms/')}}"+"/"+delId,
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
                            $('#cms_table').DataTable().ajax.reload();
                                Swal.fire(
                                'Deleted!',
                                'Cms has been deleted.',
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
        $('#cms_table').DataTable().destroy();
        fetch_data(status);
    });

});
</script>

@endsection