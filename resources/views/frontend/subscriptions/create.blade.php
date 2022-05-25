@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.subscription.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.subscriptions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.subscription.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscription.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="plan_id">{{ trans('cruds.subscription.fields.plan') }}</label>
                            <select class="form-control select2" name="plan_id" id="plan_id" required>
                                @foreach($plans as $id => $entry)
                                    <option value="{{ $id }}" {{ old('plan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('plan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('plan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscription.fields.plan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_from">{{ trans('cruds.subscription.fields.start_from') }}</label>
                            <input class="form-control date" type="text" name="start_from" id="start_from" value="{{ old('start_from') }}" required>
                            @if($errors->has('start_from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscription.fields.start_from_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_at">{{ trans('cruds.subscription.fields.end_at') }}</label>
                            <input class="form-control date" type="text" name="end_at" id="end_at" value="{{ old('end_at') }}" required>
                            @if($errors->has('end_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.subscription.fields.end_at_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_active">{{ trans('cruds.subscription.fields.is_active') }}</label>
                            </div>
                            @if($errors->has('is_active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_active') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection