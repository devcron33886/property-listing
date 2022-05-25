@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.plan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.plans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.plan.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.plan.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.plan.fields.plan_status') }}</label>
                @foreach(App\Models\Plan::PLAN_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('plan_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="plan_status_{{ $key }}" name="plan_status" value="{{ $key }}" {{ old('plan_status', '0') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="plan_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('plan_status'))
                    <span class="text-danger">{{ $errors->first('plan_status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.plan_status_helper') }}</span>
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