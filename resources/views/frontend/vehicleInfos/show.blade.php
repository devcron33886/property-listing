@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.vehicleInfo.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.vehicle-infos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $vehicleInfo->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.car') }}
                                    </th>
                                    <td>
                                        {{ $vehicleInfo->car->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.fuel') }}
                                    </th>
                                    <td>
                                        {{ App\Models\VehicleInfo::FUEL_SELECT[$vehicleInfo->fuel] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.steeling') }}
                                    </th>
                                    <td>
                                        {{ $vehicleInfo->steeling }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.air_bag') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->air_bag ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.transmission') }}
                                    </th>
                                    <td>
                                        {{ App\Models\VehicleInfo::TRANSMISSION_SELECT[$vehicleInfo->transmission] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.audio_input') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->audio_input ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.bluetooth') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->bluetooth ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.heated_seats') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->heated_seats ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.fm_radio') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->fm_radio ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.usb_input') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->usb_input ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.gps_navigation') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->gps_navigation ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleInfo.fields.sunroof') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $vehicleInfo->sunroof ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.vehicle-infos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection