@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('amenity_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.amenities.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.amenity.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.amenity.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Amenity">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.amenity.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.house') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.parking') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.garage') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.building_age') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.air_condition') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.bedding') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.heating') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.internet') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.microwave') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.smoking_allow') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.terrace') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.balcony') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.wi_fi') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.beach') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.amenity.fields.property_video') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($amenities as $key => $amenity)
                                    <tr data-entry-id="{{ $amenity->id }}">
                                        <td>
                                            {{ $amenity->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $amenity->house->property_title ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->parking ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->parking ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $amenity->garage ?? '' }}
                                        </td>
                                        <td>
                                            {{ $amenity->building_age ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->air_condition ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->air_condition ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->bedding ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->bedding ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->heating ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->heating ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->internet ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->internet ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->microwave ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->microwave ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->smoking_allow ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->smoking_allow ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->terrace ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->terrace ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->balcony ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->balcony ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->wi_fi ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->wi_fi ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $amenity->beach ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $amenity->beach ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $amenity->property_video ?? '' }}
                                        </td>
                                        <td>
                                            @can('amenity_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.amenities.show', $amenity->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('amenity_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.amenities.edit', $amenity->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('amenity_delete')
                                                <form action="{{ route('frontend.amenities.destroy', $amenity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('amenity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.amenities.massDestroy') }}",
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
  let table = $('.datatable-Amenity:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection