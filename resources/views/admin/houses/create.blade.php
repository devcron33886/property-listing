@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.house.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.houses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.house.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="property_title">{{ trans('cruds.house.fields.property_title') }}</label>
                <input class="form-control {{ $errors->has('property_title') ? 'is-invalid' : '' }}" type="text" name="property_title" id="property_title" value="{{ old('property_title', '') }}" required>
                @if($errors->has('property_title'))
                    <span class="text-danger">{{ $errors->first('property_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.property_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.house.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area">{{ trans('cruds.house.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', '') }}">
                @if($errors->has('area'))
                    <span class="text-danger">{{ $errors->first('area') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bedrooms">{{ trans('cruds.house.fields.bedrooms') }}</label>
                <input class="form-control {{ $errors->has('bedrooms') ? 'is-invalid' : '' }}" type="number" name="bedrooms" id="bedrooms" value="{{ old('bedrooms', '1') }}" step="1">
                @if($errors->has('bedrooms'))
                    <span class="text-danger">{{ $errors->first('bedrooms') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.bedrooms_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bathrooms">{{ trans('cruds.house.fields.bathrooms') }}</label>
                <input class="form-control {{ $errors->has('bathrooms') ? 'is-invalid' : '' }}" type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', '1') }}" step="0.01">
                @if($errors->has('bathrooms'))
                    <span class="text-danger">{{ $errors->first('bathrooms') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.bathrooms_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.house.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\House::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="house_image">{{ trans('cruds.house.fields.house_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('house_image') ? 'is-invalid' : '' }}" id="house_image-dropzone">
                </div>
                @if($errors->has('house_image'))
                    <span class="text-danger">{{ $errors->first('house_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.house_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.house.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="house_address">{{ trans('cruds.house.fields.house_address') }}</label>
                <input class="form-control {{ $errors->has('house_address') ? 'is-invalid' : '' }}" type="text" name="house_address" id="house_address" value="{{ old('house_address', '') }}">
                @if($errors->has('house_address'))
                    <span class="text-danger">{{ $errors->first('house_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.house.fields.house_address_helper') }}</span>
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
    var uploadedHouseImageMap = {}
Dropzone.options.houseImageDropzone = {
    url: '{{ route('admin.houses.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="house_image[]" value="' + response.name + '">')
      uploadedHouseImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedHouseImageMap[file.name]
      }
      $('form').find('input[name="house_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($house) && $house->house_image)
      var files = {!! json_encode($house->house_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="house_image[]" value="' + file.file_name + '">')
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