@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.house.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.houses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.id') }}
                        </th>
                        <td>
                            {{ $house->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.location') }}
                        </th>
                        <td>
                            {{ $house->location->state ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.property_title') }}
                        </th>
                        <td>
                            {{ $house->property_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.price') }}
                        </th>
                        <td>
                            {{ $house->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.area') }}
                        </th>
                        <td>
                            {{ $house->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.bedrooms') }}
                        </th>
                        <td>
                            {{ $house->bedrooms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.bathrooms') }}
                        </th>
                        <td>
                            {{ $house->bathrooms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\House::STATUS_SELECT[$house->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.house_image') }}
                        </th>
                        <td>
                            @if($house->house_image)
                                <a href="{{ $house->house_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $house->house_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.description') }}
                        </th>
                        <td>
                            {{ $house->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.approved') }}
                        </th>
                        <td>
                            {{ App\Models\House::APPROVED_RADIO[$house->approved] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.house.fields.house_address') }}
                        </th>
                        <td>
                            {{ $house->house_address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.houses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection