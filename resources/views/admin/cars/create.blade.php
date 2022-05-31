@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.car.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.car.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="model_year">{{ trans('cruds.car.fields.model_year') }}</label>
                <input class="form-control {{ $errors->has('model_year') ? 'is-invalid' : '' }}" type="text" name="model_year" id="model_year" value="{{ old('model_year', '') }}" required>
                @if($errors->has('model_year'))
                    <span class="text-danger">{{ $errors->first('model_year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.model_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.car.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seats">{{ trans('cruds.car.fields.seats') }}</label>
                <input class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}" type="number" name="seats" id="seats" value="{{ old('seats', '') }}" step="1" required>
                @if($errors->has('seats'))
                    <span class="text-danger">{{ $errors->first('seats') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.seats_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.car.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.car.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Car::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="car_image">{{ trans('cruds.car.fields.car_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('car_image') ? 'is-invalid' : '' }}" id="car_image-dropzone">
                </div>
                @if($errors->has('car_image'))
                    <span class="text-danger">{{ $errors->first('car_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.car_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location_id">{{ trans('cruds.car.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id">
                    @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.car.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.car.fields.address_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedCarImageMap = {}
Dropzone.options.carImageDropzone = {
    url: '{{ route('admin.cars.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="car_image[]" value="' + response.name + '">')
      uploadedCarImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCarImageMap[file.name]
      }
      $('form').find('input[name="car_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($car) && $car->car_image)
      var files = {!! json_encode($car->car_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="car_image[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection