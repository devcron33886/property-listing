<div class="m-3">
    @can('house_gallery_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.house-galleries.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.houseGallery.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.houseGallery.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-houseHouseGalleries">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.houseGallery.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.houseGallery.fields.house') }}
                            </th>
                            <th>
                                {{ trans('cruds.houseGallery.fields.house_photos') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($houseGalleries as $key => $houseGallery)
                            <tr data-entry-id="{{ $houseGallery->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $houseGallery->id ?? '' }}
                                </td>
                                <td>
                                    {{ $houseGallery->house->property_title ?? '' }}
                                </td>
                                <td>
                                    @foreach($houseGallery->house_photos as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @can('house_gallery_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.house-galleries.show', $houseGallery->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('house_gallery_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.house-galleries.edit', $houseGallery->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('house_gallery_delete')
                                        <form action="{{ route('admin.house-galleries.destroy', $houseGallery->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('house_gallery_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.house-galleries.massDestroy') }}",
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
  let table = $('.datatable-houseHouseGalleries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection