@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prodi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prodis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.id') }}
                        </th>
                        <td>
                            {{ $prodi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.nama_prodi') }}
                        </th>
                        <td>
                            {{ $prodi->nama_prodi }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prodis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#prodi_mahasiswas" role="tab" data-toggle="tab">
                {{ trans('cruds.mahasiswa.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="prodi_mahasiswas">
            @includeIf('admin.prodis.relationships.prodiMahasiswas', ['mahasiswas' => $prodi->prodiMahasiswas])
        </div>
    </div>
</div>

@endsection