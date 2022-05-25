@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.carMedium.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.car-media.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="car_video">{{ trans('cruds.carMedium.fields.car_video') }}</label>
                            <input class="form-control" type="text" name="car_video" id="car_video" value="{{ old('car_video', '') }}">
                            @if($errors->has('car_video'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('car_video') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carMedium.fields.car_video_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="car_gallery">{{ trans('cruds.carMedium.fields.car_gallery') }}</label>
                            <div class="needsclick dropzone" id="car_gallery-dropzone">
                            </div>
                            @if($errors->has('car_gallery'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('car_gallery') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carMedium.fields.car_gallery_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="car_id">{{ trans('cruds.carMedium.fields.car') }}</label>
                            <select class="form-control select2" name="car_id" id="car_id">
                                @foreach($cars as $id => $entry)
                                    <option value="{{ $id }}" {{ old('car_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('car'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('car') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carMedium.fields.car_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedCarGalleryMap = {}
Dropzone.options.carGalleryDropzone = {
    url: '{{ route('frontend.car-media.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="car_gallery[]" value="' + response.name + '">')
      uploadedCarGalleryMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedCarGalleryMap[file.name]
      }
      $('form').find('input[name="car_gallery[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($carMedium) && $carMedium->car_gallery)
      var files = {!! json_encode($carMedium->car_gallery) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="car_gallery[]" value="' + file.file_name + '">')
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