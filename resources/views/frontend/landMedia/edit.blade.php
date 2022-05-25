@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.landMedium.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.land-media.update", [$landMedium->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="land_id">{{ trans('cruds.landMedium.fields.land') }}</label>
                            <select class="form-control select2" name="land_id" id="land_id" required>
                                @foreach($lands as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('land_id') ? old('land_id') : $landMedium->land->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('land'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('land') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.landMedium.fields.land_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="video">{{ trans('cruds.landMedium.fields.video') }}</label>
                            <input class="form-control" type="text" name="video" id="video" value="{{ old('video', $landMedium->video) }}">
                            @if($errors->has('video'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('video') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.landMedium.fields.video_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="plot_gallery">{{ trans('cruds.landMedium.fields.plot_gallery') }}</label>
                            <div class="needsclick dropzone" id="plot_gallery-dropzone">
                            </div>
                            @if($errors->has('plot_gallery'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('plot_gallery') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.landMedium.fields.plot_gallery_helper') }}</span>
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
    var uploadedPlotGalleryMap = {}
Dropzone.options.plotGalleryDropzone = {
    url: '{{ route('frontend.land-media.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="plot_gallery[]" value="' + response.name + '">')
      uploadedPlotGalleryMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPlotGalleryMap[file.name]
      }
      $('form').find('input[name="plot_gallery[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($landMedium) && $landMedium->plot_gallery)
      var files = {!! json_encode($landMedium->plot_gallery) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="plot_gallery[]" value="' + file.file_name + '">')
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