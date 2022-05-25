@extends('layouts.admin')
@section('content')
@can('advert_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.adverts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.advert.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.advert.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Advert">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.advert.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.advert.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.advert.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.advert.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.advert.fields.published') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adverts as $key => $advert)
                        <tr data-entry-id="{{ $advert->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $advert->id ?? '' }}
                            </td>
                            <td>
                                {{ $advert->title ?? '' }}
                            </td>
                            <td>
                                @if($advert->image)
                                    <a href="{{ $advert->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $advert->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $advert->link ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $advert->published ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $advert->published ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('advert_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.adverts.show', $advert->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('advert_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.adverts.edit', $advert->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('advert_delete')
                                    <form action="{{ route('admin.adverts.destroy', $advert->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('advert_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.adverts.massDestroy') }}",
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
  let table = $('.datatable-Advert:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection