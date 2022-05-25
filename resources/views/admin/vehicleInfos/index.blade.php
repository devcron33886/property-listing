@extends('layouts.admin')
@section('content')
@can('vehicle_info_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.vehicle-infos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.vehicleInfo.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.vehicleInfo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleInfo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.car') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.fuel') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.steeling') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.air_bag') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.transmission') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.audio_input') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.bluetooth') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.heated_seats') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.fm_radio') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.usb_input') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.gps_navigation') }}
                        </th>
                        <th>
                            {{ trans('cruds.vehicleInfo.fields.sunroof') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicleInfos as $key => $vehicleInfo)
                        <tr data-entry-id="{{ $vehicleInfo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $vehicleInfo->id ?? '' }}
                            </td>
                            <td>
                                {{ $vehicleInfo->car->title ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\VehicleInfo::FUEL_SELECT[$vehicleInfo->fuel] ?? '' }}
                            </td>
                            <td>
                                {{ $vehicleInfo->steeling ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->air_bag ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->air_bag ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ App\Models\VehicleInfo::TRANSMISSION_SELECT[$vehicleInfo->transmission] ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->audio_input ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->audio_input ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->bluetooth ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->bluetooth ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->heated_seats ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->heated_seats ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->fm_radio ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->fm_radio ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->usb_input ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->usb_input ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->gps_navigation ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->gps_navigation ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $vehicleInfo->sunroof ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $vehicleInfo->sunroof ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('vehicle_info_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.vehicle-infos.show', $vehicleInfo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('vehicle_info_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.vehicle-infos.edit', $vehicleInfo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('vehicle_info_delete')
                                    <form action="{{ route('admin.vehicle-infos.destroy', $vehicleInfo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vehicle_info_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.vehicle-infos.massDestroy') }}",
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
  let table = $('.datatable-VehicleInfo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection