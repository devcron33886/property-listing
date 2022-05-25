@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.amenity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.id') }}
                        </th>
                        <td>
                            {{ $amenity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.house') }}
                        </th>
                        <td>
                            {{ $amenity->house->property_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.parking') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->parking ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.garage') }}
                        </th>
                        <td>
                            {{ $amenity->garage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.building_age') }}
                        </th>
                        <td>
                            {{ $amenity->building_age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.air_condition') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->air_condition ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.bedding') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->bedding ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.heating') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->heating ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.internet') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->internet ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.microwave') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->microwave ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.smoking_allow') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->smoking_allow ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.terrace') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->terrace ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.balcony') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->balcony ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.wi_fi') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->wi_fi ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.beach') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $amenity->beach ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.amenity.fields.property_video') }}
                        </th>
                        <td>
                            {{ $amenity->property_video }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.amenities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection