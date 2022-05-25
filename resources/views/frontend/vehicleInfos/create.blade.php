@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.vehicleInfo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.vehicle-infos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="car_id">{{ trans('cruds.vehicleInfo.fields.car') }}</label>
                            <select class="form-control select2" name="car_id" id="car_id" required>
                                @foreach($cars as $id => $entry)
                                    <option value="{{ $id }}" {{ old('car_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('car'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('car') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.car_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.vehicleInfo.fields.fuel') }}</label>
                            <select class="form-control" name="fuel" id="fuel" required>
                                <option value disabled {{ old('fuel', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\VehicleInfo::FUEL_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('fuel', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fuel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fuel') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.fuel_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="steeling">{{ trans('cruds.vehicleInfo.fields.steeling') }}</label>
                            <input class="form-control" type="text" name="steeling" id="steeling" value="{{ old('steeling', '') }}" required>
                            @if($errors->has('steeling'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('steeling') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.steeling_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="air_bag" value="0">
                                <input type="checkbox" name="air_bag" id="air_bag" value="1" {{ old('air_bag', 0) == 1 ? 'checked' : '' }}>
                                <label for="air_bag">{{ trans('cruds.vehicleInfo.fields.air_bag') }}</label>
                            </div>
                            @if($errors->has('air_bag'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('air_bag') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.air_bag_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.vehicleInfo.fields.transmission') }}</label>
                            <select class="form-control" name="transmission" id="transmission" required>
                                <option value disabled {{ old('transmission', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\VehicleInfo::TRANSMISSION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('transmission', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('transmission'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('transmission') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.transmission_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="audio_input" value="0">
                                <input type="checkbox" name="audio_input" id="audio_input" value="1" {{ old('audio_input', 0) == 1 ? 'checked' : '' }}>
                                <label for="audio_input">{{ trans('cruds.vehicleInfo.fields.audio_input') }}</label>
                            </div>
                            @if($errors->has('audio_input'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('audio_input') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.audio_input_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="bluetooth" value="0">
                                <input type="checkbox" name="bluetooth" id="bluetooth" value="1" {{ old('bluetooth', 0) == 1 ? 'checked' : '' }}>
                                <label for="bluetooth">{{ trans('cruds.vehicleInfo.fields.bluetooth') }}</label>
                            </div>
                            @if($errors->has('bluetooth'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bluetooth') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.bluetooth_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="heated_seats" value="0">
                                <input type="checkbox" name="heated_seats" id="heated_seats" value="1" {{ old('heated_seats', 0) == 1 ? 'checked' : '' }}>
                                <label for="heated_seats">{{ trans('cruds.vehicleInfo.fields.heated_seats') }}</label>
                            </div>
                            @if($errors->has('heated_seats'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heated_seats') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.heated_seats_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="fm_radio" value="0">
                                <input type="checkbox" name="fm_radio" id="fm_radio" value="1" {{ old('fm_radio', 0) == 1 ? 'checked' : '' }}>
                                <label for="fm_radio">{{ trans('cruds.vehicleInfo.fields.fm_radio') }}</label>
                            </div>
                            @if($errors->has('fm_radio'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fm_radio') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.fm_radio_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="usb_input" value="0">
                                <input type="checkbox" name="usb_input" id="usb_input" value="1" {{ old('usb_input', 0) == 1 ? 'checked' : '' }}>
                                <label for="usb_input">{{ trans('cruds.vehicleInfo.fields.usb_input') }}</label>
                            </div>
                            @if($errors->has('usb_input'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('usb_input') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.usb_input_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="gps_navigation" value="0">
                                <input type="checkbox" name="gps_navigation" id="gps_navigation" value="1" {{ old('gps_navigation', 0) == 1 ? 'checked' : '' }}>
                                <label for="gps_navigation">{{ trans('cruds.vehicleInfo.fields.gps_navigation') }}</label>
                            </div>
                            @if($errors->has('gps_navigation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gps_navigation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.gps_navigation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="sunroof" value="0">
                                <input type="checkbox" name="sunroof" id="sunroof" value="1" {{ old('sunroof', 0) == 1 ? 'checked' : '' }}>
                                <label for="sunroof">{{ trans('cruds.vehicleInfo.fields.sunroof') }}</label>
                            </div>
                            @if($errors->has('sunroof'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sunroof') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleInfo.fields.sunroof_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection