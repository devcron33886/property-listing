@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.car.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.id') }}
                        </th>
                        <td>
                            {{ $car->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.title') }}
                        </th>
                        <td>
                            {{ $car->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.model_year') }}
                        </th>
                        <td>
                            {{ $car->model_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.price') }}
                        </th>
                        <td>
                            {{ $car->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.seats') }}
                        </th>
                        <td>
                            {{ $car->seats }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.description') }}
                        </th>
                        <td>
                            {{ $car->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Car::STATUS_SELECT[$car->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.car_image') }}
                        </th>
                        <td>
                            @foreach($car->car_image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $car->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.location') }}
                        </th>
                        <td>
                            {{ $car->location->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.car.fields.address') }}
                        </th>
                        <td>
                            {{ $car->address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection