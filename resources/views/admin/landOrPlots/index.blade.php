@extends('layouts.admin')
@section('content')
@can('land_or_plot_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.land-or-plots.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.landOrPlot.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.landOrPlot.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LandOrPlot">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.landOrPlot.fields.property_image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($landOrPlots as $key => $landOrPlot)
                        <tr data-entry-id="{{ $landOrPlot->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $landOrPlot->id ?? '' }}
                            </td>
                            <td>
                                {{ $landOrPlot->title ?? '' }}
                            </td>
                            <td>
                                {{ $landOrPlot->price ?? '' }}
                            </td>
                            <td>
                                {{ $landOrPlot->location->state ?? '' }}
                            </td>
                            <td>
                                {{ $landOrPlot->area ?? '' }}
                            </td>
                            <td>
                                {{ $landOrPlot->description ?? '' }}
                            </td>
                            <td>
                                @foreach($landOrPlot->property_image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('land_or_plot_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.land-or-plots.show', $landOrPlot->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('land_or_plot_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.land-or-plots.edit', $landOrPlot->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('land_or_plot_delete')
                                    <form action="{{ route('admin.land-or-plots.destroy', $landOrPlot->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('land_or_plot_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.land-or-plots.massDestroy') }}",
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
  let table = $('.datatable-LandOrPlot:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection