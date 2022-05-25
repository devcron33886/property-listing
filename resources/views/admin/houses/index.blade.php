@extends('layouts.admin')
@section('content')
@can('house_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.houses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.house.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.house.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-House">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.house.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.house.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.loaction.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.house.fields.property_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.house.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.house.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.house.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.house.fields.approved') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($houses as $key => $house)
                        <tr data-entry-id="{{ $house->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $house->id ?? '' }}
                            </td>
                            <td>
                                {{ $house->location->state ?? '' }}
                            </td>
                            <td>
                                {{ $house->location->state ?? '' }}
                            </td>
                            <td>
                                {{ $house->property_title ?? '' }}
                            </td>
                            <td>
                                {{ $house->price ?? '' }}
                            </td>
                            <td>
                                {{ $house->area ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\House::STATUS_SELECT[$house->status] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\House::APPROVED_RADIO[$house->approved] ?? '' }}
                            </td>
                            <td>
                                @can('house_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.houses.show', $house->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('house_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.houses.edit', $house->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('house_delete')
                                    <form action="{{ route('admin.houses.destroy', $house->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('house_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.houses.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-House:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection