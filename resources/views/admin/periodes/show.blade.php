@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.periode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.periodes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.periode.fields.id') }}
                        </th>
                        <td>
                            {{ $periode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.periode.fields.tahun_periode') }}
                        </th>
                        <td>
                            {{ $periode->tahun_periode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            {{ $periode->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.periodes.index') }}">
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
            <a class="nav-link" href="#periode_mahasiswas" role="tab" data-toggle="tab">
                {{ trans('cruds.mahasiswa.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="periode_mahasiswas">
            @includeIf('admin.periodes.relationships.periodeMahasiswas', ['mahasiswas' => $periode->periodeMahasiswas])
        </div>
    </div>
</div>

@endsection