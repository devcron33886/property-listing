@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.amenity.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.amenities.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="house_id">{{ trans('cruds.amenity.fields.house') }}</label>
                            <select class="form-control select2" name="house_id" id="house_id" required>
                                @foreach($houses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('house_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('house'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('house') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.house_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="parking" value="0">
                                <input type="checkbox" name="parking" id="parking" value="1" {{ old('parking', 0) == 1 ? 'checked' : '' }}>
                                <label for="parking">{{ trans('cruds.amenity.fields.parking') }}</label>
                            </div>
                            @if($errors->has('parking'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('parking') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.parking_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="garage">{{ trans('cruds.amenity.fields.garage') }}</label>
                            <input class="form-control" type="number" name="garage" id="garage" value="{{ old('garage', '') }}" step="1">
                            @if($errors->has('garage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('garage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.garage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="building_age">{{ trans('cruds.amenity.fields.building_age') }}</label>
                            <input class="form-control" type="text" name="building_age" id="building_age" value="{{ old('building_age', '') }}">
                            @if($errors->has('building_age'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('building_age') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.building_age_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="air_condition" value="0">
                                <input type="checkbox" name="air_condition" id="air_condition" value="1" {{ old('air_condition', 0) == 1 ? 'checked' : '' }}>
                                <label for="air_condition">{{ trans('cruds.amenity.fields.air_condition') }}</label>
                            </div>
                            @if($errors->has('air_condition'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('air_condition') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.air_condition_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="bedding" value="0">
                                <input type="checkbox" name="bedding" id="bedding" value="1" {{ old('bedding', 0) == 1 ? 'checked' : '' }}>
                                <label for="bedding">{{ trans('cruds.amenity.fields.bedding') }}</label>
                            </div>
                            @if($errors->has('bedding'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bedding') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.bedding_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="heating" value="0">
                                <input type="checkbox" name="heating" id="heating" value="1" {{ old('heating', 0) == 1 ? 'checked' : '' }}>
                                <label for="heating">{{ trans('cruds.amenity.fields.heating') }}</label>
                            </div>
                            @if($errors->has('heating'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heating') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.heating_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="internet" value="0">
                                <input type="checkbox" name="internet" id="internet" value="1" {{ old('internet', 0) == 1 ? 'checked' : '' }}>
                                <label for="internet">{{ trans('cruds.amenity.fields.internet') }}</label>
                            </div>
                            @if($errors->has('internet'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internet') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.internet_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="microwave" value="0">
                                <input type="checkbox" name="microwave" id="microwave" value="1" {{ old('microwave', 0) == 1 ? 'checked' : '' }}>
                                <label for="microwave">{{ trans('cruds.amenity.fields.microwave') }}</label>
                            </div>
                            @if($errors->has('microwave'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('microwave') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.microwave_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="smoking_allow" value="0">
                                <input type="checkbox" name="smoking_allow" id="smoking_allow" value="1" {{ old('smoking_allow', 0) == 1 ? 'checked' : '' }}>
                                <label for="smoking_allow">{{ trans('cruds.amenity.fields.smoking_allow') }}</label>
                            </div>
                            @if($errors->has('smoking_allow'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('smoking_allow') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.smoking_allow_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="terrace" value="0">
                                <input type="checkbox" name="terrace" id="terrace" value="1" {{ old('terrace', 0) == 1 ? 'checked' : '' }}>
                                <label for="terrace">{{ trans('cruds.amenity.fields.terrace') }}</label>
                            </div>
                            @if($errors->has('terrace'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('terrace') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.terrace_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="balcony" value="0">
                                <input type="checkbox" name="balcony" id="balcony" value="1" {{ old('balcony', 0) == 1 ? 'checked' : '' }}>
                                <label for="balcony">{{ trans('cruds.amenity.fields.balcony') }}</label>
                            </div>
                            @if($errors->has('balcony'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('balcony') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.balcony_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="wi_fi" value="0">
                                <input type="checkbox" name="wi_fi" id="wi_fi" value="1" {{ old('wi_fi', 0) == 1 ? 'checked' : '' }}>
                                <label for="wi_fi">{{ trans('cruds.amenity.fields.wi_fi') }}</label>
                            </div>
                            @if($errors->has('wi_fi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wi_fi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.wi_fi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="beach" value="0">
                                <input type="checkbox" name="beach" id="beach" value="1" {{ old('beach', 0) == 1 ? 'checked' : '' }}>
                                <label for="beach">{{ trans('cruds.amenity.fields.beach') }}</label>
                            </div>
                            @if($errors->has('beach'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('beach') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.beach_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="property_video">{{ trans('cruds.amenity.fields.property_video') }}</label>
                            <input class="form-control" type="text" name="property_video" id="property_video" value="{{ old('property_video', '') }}">
                            @if($errors->has('property_video'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('property_video') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.amenity.fields.property_video_helper') }}</span>
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