@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.subscription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subscriptions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.subscription.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="plan_id">{{ trans('cruds.subscription.fields.plan') }}</label>
                <select class="form-control select2 {{ $errors->has('plan') ? 'is-invalid' : '' }}" name="plan_id" id="plan_id" required>
                    @foreach($plans as $id => $entry)
                        <option value="{{ $id }}" {{ old('plan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('plan'))
                    <span class="text-danger">{{ $errors->first('plan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.plan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_from">{{ trans('cruds.subscription.fields.start_from') }}</label>
                <input class="form-control date {{ $errors->has('start_from') ? 'is-invalid' : '' }}" type="text" name="start_from" id="start_from" value="{{ old('start_from') }}" required>
                @if($errors->has('start_from'))
                    <span class="text-danger">{{ $errors->first('start_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.start_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_at">{{ trans('cruds.subscription.fields.end_at') }}</label>
                <input class="form-control date {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text" name="end_at" id="end_at" value="{{ old('end_at') }}" required>
                @if($errors->has('end_at'))
                    <span class="text-danger">{{ $errors->first('end_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.end_at_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.subscription.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.is_active_helper') }}</span>
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