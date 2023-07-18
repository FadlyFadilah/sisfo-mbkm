@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.laporan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.laporans.update", [$laporan->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="pengajuan_id">{{ trans('cruds.laporan.fields.pengajuan') }}</label>
                            <select class="form-control select2" name="pengajuan_id" id="pengajuan_id" required>
                                @foreach($pengajuans as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('pengajuan_id') ? old('pengajuan_id') : $laporan->pengajuan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pengajuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pengajuan') }}
                                </div>
                            @endif
                            <span class="help-block text-danger">{{ trans('cruds.laporan.fields.pengajuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="sertifikat">{{ trans('cruds.laporan.fields.sertifikat') }}</label>
                            <div class="needsclick dropzone" id="sertifikat-dropzone">
                            </div>
                            @if($errors->has('sertifikat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sertifikat') }}
                                </div>
                            @endif
                            <span class="help-block text-danger">{{ trans('cruds.laporan.fields.sertifikat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="laporan">{{ trans('cruds.laporan.fields.laporan') }}</label>
                            <div class="needsclick dropzone" id="laporan-dropzone">
                            </div>
                            @if($errors->has('laporan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('laporan') }}
                                </div>
                            @endif
                            <span class="help-block text-danger">{{ trans('cruds.laporan.fields.laporan_helper') }}</span>
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
    Dropzone.options.sertifikatDropzone = {
    url: '{{ route('frontend.laporans.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="sertifikat"]').remove()
      $('form').append('<input type="hidden" name="sertifikat" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="sertifikat"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($laporan) && $laporan->sertifikat)
      var file = {!! json_encode($laporan->sertifikat) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="sertifikat" value="' + file.file_name + '">')
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
    Dropzone.options.laporanDropzone = {
    url: '{{ route('frontend.laporans.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="laporan"]').remove()
      $('form').append('<input type="hidden" name="laporan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="laporan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($laporan) && $laporan->laporan)
      var file = {!! json_encode($laporan->laporan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="laporan" value="' + file.file_name + '">')
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
@endsection