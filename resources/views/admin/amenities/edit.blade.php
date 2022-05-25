@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.amenity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.amenities.update", [$amenity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="house_id">{{ trans('cruds.amenity.fields.house') }}</label>
                <select class="form-control select2 {{ $errors->has('house') ? 'is-invalid' : '' }}" name="house_id" id="house_id" required>
                    @foreach($houses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('house_id') ? old('house_id') : $amenity->house->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('house'))
                    <span class="text-danger">{{ $errors->first('house') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.house_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('parking') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="parking" value="0">
                    <input class="form-check-input" type="checkbox" name="parking" id="parking" value="1" {{ $amenity->parking || old('parking', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="parking">{{ trans('cruds.amenity.fields.parking') }}</label>
                </div>
                @if($errors->has('parking'))
                    <span class="text-danger">{{ $errors->first('parking') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.parking_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="garage">{{ trans('cruds.amenity.fields.garage') }}</label>
                <input class="form-control {{ $errors->has('garage') ? 'is-invalid' : '' }}" type="number" name="garage" id="garage" value="{{ old('garage', $amenity->garage) }}" step="1">
                @if($errors->has('garage'))
                    <span class="text-danger">{{ $errors->first('garage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.garage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="building_age">{{ trans('cruds.amenity.fields.building_age') }}</label>
                <input class="form-control {{ $errors->has('building_age') ? 'is-invalid' : '' }}" type="text" name="building_age" id="building_age" value="{{ old('building_age', $amenity->building_age) }}">
                @if($errors->has('building_age'))
                    <span class="text-danger">{{ $errors->first('building_age') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.building_age_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('air_condition') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="air_condition" value="0">
                    <input class="form-check-input" type="checkbox" name="air_condition" id="air_condition" value="1" {{ $amenity->air_condition || old('air_condition', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="air_condition">{{ trans('cruds.amenity.fields.air_condition') }}</label>
                </div>
                @if($errors->has('air_condition'))
                    <span class="text-danger">{{ $errors->first('air_condition') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.air_condition_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bedding') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bedding" value="0">
                    <input class="form-check-input" type="checkbox" name="bedding" id="bedding" value="1" {{ $amenity->bedding || old('bedding', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bedding">{{ trans('cruds.amenity.fields.bedding') }}</label>
                </div>
                @if($errors->has('bedding'))
                    <span class="text-danger">{{ $errors->first('bedding') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.bedding_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('heating') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="heating" value="0">
                    <input class="form-check-input" type="checkbox" name="heating" id="heating" value="1" {{ $amenity->heating || old('heating', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="heating">{{ trans('cruds.amenity.fields.heating') }}</label>
                </div>
                @if($errors->has('heating'))
                    <span class="text-danger">{{ $errors->first('heating') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.heating_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('internet') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="internet" value="0">
                    <input class="form-check-input" type="checkbox" name="internet" id="internet" value="1" {{ $amenity->internet || old('internet', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="internet">{{ trans('cruds.amenity.fields.internet') }}</label>
                </div>
                @if($errors->has('internet'))
                    <span class="text-danger">{{ $errors->first('internet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.internet_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('microwave') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="microwave" value="0">
                    <input class="form-check-input" type="checkbox" name="microwave" id="microwave" value="1" {{ $amenity->microwave || old('microwave', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="microwave">{{ trans('cruds.amenity.fields.microwave') }}</label>
                </div>
                @if($errors->has('microwave'))
                    <span class="text-danger">{{ $errors->first('microwave') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.microwave_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('smoking_allow') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="smoking_allow" value="0">
                    <input class="form-check-input" type="checkbox" name="smoking_allow" id="smoking_allow" value="1" {{ $amenity->smoking_allow || old('smoking_allow', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="smoking_allow">{{ trans('cruds.amenity.fields.smoking_allow') }}</label>
                </div>
                @if($errors->has('smoking_allow'))
                    <span class="text-danger">{{ $errors->first('smoking_allow') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.smoking_allow_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('terrace') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="terrace" value="0">
                    <input class="form-check-input" type="checkbox" name="terrace" id="terrace" value="1" {{ $amenity->terrace || old('terrace', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="terrace">{{ trans('cruds.amenity.fields.terrace') }}</label>
                </div>
                @if($errors->has('terrace'))
                    <span class="text-danger">{{ $errors->first('terrace') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.terrace_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('balcony') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="balcony" value="0">
                    <input class="form-check-input" type="checkbox" name="balcony" id="balcony" value="1" {{ $amenity->balcony || old('balcony', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="balcony">{{ trans('cruds.amenity.fields.balcony') }}</label>
                </div>
                @if($errors->has('balcony'))
                    <span class="text-danger">{{ $errors->first('balcony') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.balcony_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('wi_fi') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="wi_fi" value="0">
                    <input class="form-check-input" type="checkbox" name="wi_fi" id="wi_fi" value="1" {{ $amenity->wi_fi || old('wi_fi', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="wi_fi">{{ trans('cruds.amenity.fields.wi_fi') }}</label>
                </div>
                @if($errors->has('wi_fi'))
                    <span class="text-danger">{{ $errors->first('wi_fi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.wi_fi_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('beach') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="beach" value="0">
                    <input class="form-check-input" type="checkbox" name="beach" id="beach" value="1" {{ $amenity->beach || old('beach', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="beach">{{ trans('cruds.amenity.fields.beach') }}</label>
                </div>
                @if($errors->has('beach'))
                    <span class="text-danger">{{ $errors->first('beach') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.amenity.fields.beach_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="property_video">{{ trans('cruds.amenity.fields.property_video') }}</label>
                <input class="form-control {{ $errors->has('property_video') ? 'is-invalid' : '' }}" type="text" name="property_video" id="property_video" value="{{ old('property_video', $amenity->property_video) }}">
                @if($errors->has('property_video'))
                    <span class="text-danger">{{ $errors->first('property_video') }}</span>
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



@endsection