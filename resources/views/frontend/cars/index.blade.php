@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('car_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.cars.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.car.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.car.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Car">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.car.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.model_year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.seats') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.approved') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.car.fields.address') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $key => $car)
                                    <tr data-entry-id="{{ $car->id }}">
                                        <td>
                                            {{ $car->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $car->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $car->model_year ?? '' }}
                                        </td>
                                        <td>
                                            {{ $car->price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $car->seats ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Car::STATUS_SELECT[$car->status] ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $car->approved ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $car->approved ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $car->location->state ?? '' }}
                                        </td>
                                        <td>
                                            {{ $car->address ?? '' }}
                                        </td>
                                        <td>
                                            @can('car_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.cars.show', $car->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('car_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.cars.edit', $car->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('car_delete')
                                                <form action="{{ route('frontend.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('car_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.cars.massDestroy') }}",
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
  let table = $('.datatable-Car:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection