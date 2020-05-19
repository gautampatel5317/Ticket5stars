@extends('backend.layouts.admin')
@section('content')
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
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
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
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $key => $customer)
                        <tr data-entry-id="{{ $customer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $customer->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $customer->family_name ?? '' }}
                            </td>
                            <td>
                                {{ $customer->email ?? '' }}
                            </td>
                            <td>
                                {{ $customer->experience ?? '' }}
                            </td>
                            <td>
                                {{ $customer->business ?? '' }}
                            </td>
                            <td>
                                @can('customer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.customers.show', $customer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('customer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.customers.edit', $customer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('customer_delete')
                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
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
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customers.massDestroy') }}",
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
          headers: {'x-csrf-token': '{{ csrf_token() }}'},
          method: 'POST',
          //type: "DELETE",
          url: config.url,
          data: { ids: ids,  _token : '{{ csrf_token() }}' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('customer_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection