@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('subscription_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.subscriptions.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.subscription.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.subscription.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Subscription">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.subscription.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscription.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscription.fields.plan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscription.fields.start_from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscription.fields.end_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subscription.fields.is_active') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $key => $subscription)
                                    <tr data-entry-id="{{ $subscription->id }}">
                                        <td>
                                            {{ $subscription->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscription->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscription->plan->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscription->start_from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subscription->end_at ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $subscription->is_active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $subscription->is_active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('subscription_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.subscriptions.show', $subscription->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('subscription_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.subscriptions.edit', $subscription->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('subscription_delete')
                                                <form action="{{ route('frontend.subscriptions.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('subscription_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.subscriptions.massDestroy') }}",
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
  let table = $('.datatable-Subscription:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection