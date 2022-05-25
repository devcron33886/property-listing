@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.electronic.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.electronics.update", [$electronic->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.electronic.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $electronic->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.electronic.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.electronic.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', $electronic->price) }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.electronic.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="product_image">{{ trans('cruds.electronic.fields.product_image') }}</label>
                            <div class="needsclick dropzone" id="product_image-dropzone">
                            </div>
                            @if($errors->has('product_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.electronic.fields.product_image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="description">{{ trans('cruds.electronic.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description" required>{{ old('description', $electronic->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.electronic.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.electronic.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Electronic::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $electronic->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.electronic.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_gallery">{{ trans('cruds.electronic.fields.product_gallery') }}</label>
                            <div class="needsclick dropzone" id="product_gallery-dropzone">
                            </div>
                            @if($errors->has('product_gallery'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_gallery') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.electronic.fields.product_gallery_helper') }}</span>
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
    Dropzone.options.productImageDropzone = {
    url: '{{ route('frontend.electronics.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="product_image"]').remove()
      $('form').append('<input type="hidden" name="product_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="product_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($electronic) && $electronic->product_image)
      var file = {!! json_encode($electronic->product_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="product_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    var uploadedProductGalleryMap = {}
Dropzone.options.productGalleryDropzone = {
    url: '{{ route('frontend.electronics.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="product_gallery[]" value="' + response.name + '">')
      uploadedProductGalleryMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedProductGalleryMap[file.name]
      }
      $('form').find('input[name="product_gallery[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($electronic) && $electronic->product_gallery)
      var files = {!! json_encode($electronic->product_gallery) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="product_gallery[]" value="' + file.file_name + '">')
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