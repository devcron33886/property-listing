@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.houseGallery.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.house-galleries.update", [$houseGallery->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="house_id">{{ trans('cruds.houseGallery.fields.house') }}</label>
                <select class="form-control select2 {{ $errors->has('house') ? 'is-invalid' : '' }}" name="house_id" id="house_id" required>
                    @foreach($houses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('house_id') ? old('house_id') : $houseGallery->house->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('house'))
                    <span class="text-danger">{{ $errors->first('house') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.houseGallery.fields.house_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="house_photos">{{ trans('cruds.houseGallery.fields.house_photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('house_photos') ? 'is-invalid' : '' }}" id="house_photos-dropzone">
                </div>
                @if($errors->has('house_photos'))
                    <span class="text-danger">{{ $errors->first('house_photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.houseGallery.fields.house_photos_helper') }}</span>
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
    var uploadedHousePhotosMap = {}
Dropzone.options.housePhotosDropzone = {
    url: '{{ route('admin.house-galleries.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="house_photos[]" value="' + response.name + '">')
      uploadedHousePhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedHousePhotosMap[file.name]
      }
      $('form').find('input[name="house_photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($houseGallery) && $houseGallery->house_photos)
      var files = {!! json_encode($houseGallery->house_photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="house_photos[]" value="' + file.file_name + '">')
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