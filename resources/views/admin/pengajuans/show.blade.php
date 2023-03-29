@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.pengajuan.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.pengajuans.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.pengajuan.fields.id') }}
                            </th>
                            <td>
                                {{ $pengajuan->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pengajuan.fields.mahasiswa') }}
                            </th>
                            <td>
                                {{ $pengajuan->mahasiswa->nama_lengkap ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pengajuan.fields.program') }}
                            </th>
                            <td>
                                {{ $pengajuan->program->nama_program ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pengajuan.fields.semester') }}
                            </th>
                            <td>
                                {{ $pengajuan->semester }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.pengajuan.fields.no_hp') }}
                            </th>
                            <td>
                                {{ $pengajuan->no_hp }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Verifikasi
                            </th>
                            <td>
                                {{ $pengajuan->verif }} 
                                @if ($pengajuan->verif === 'Verifikasi')
                                <i class="fas fa-check fa-2x text-success"></i>
                                @else
                                <i class="fa-2x fas fa-times text-danger"></i>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.pengajuans.verif', $pengajuan->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="verif">Verifikasi</label>
                                        <select class="form-control {{ $errors->has('verif') ? 'is-invalid' : '' }}"
                                            name="verif" id="verif">
                                            <option hidden selected>Silihkan Pilih!</option>
                                            <option value="Verifikasi">Verifikasi</option>
                                            <option value="Tolak">Tolak</option>
                                        </select>
                                        <br>
                                        <input type="submit" class="btn btn-success" value="simpan">
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.pengajuans.index') }}">
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
                <a class="nav-link" href="#pengajuan_laporans" role="tab" data-toggle="tab">
                    {{ trans('cruds.laporan.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="pengajuan_laporans">
                @includeIf('admin.pengajuans.relationships.pengajuanLaporans', [
                    'laporans' => $pengajuan->pengajuanLaporans,
                ])
            </div>
        </div>
    </div>
@endsection
