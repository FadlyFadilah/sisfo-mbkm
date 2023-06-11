@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        @can('mahasiswa_create')
            <div class="col-lg-6">
                <a class="btn btn-success" href="{{ route('admin.mahasiswas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.mahasiswa.title_singular') }}
                </a>
            </div>
        @endcan
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }}{{ trans('cruds.mahasiswa.title_singular') }} : {{ $nama }},
            {{ $prodi }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Mahasiswa">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.mahasiswa.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.mahasiswa.fields.nama_lengkap') }}
                            </th>
                            <th>
                                {{ trans('cruds.mahasiswa.fields.nim') }}
                            </th>
                            <th>
                                {{ trans('cruds.mahasiswa.fields.jenis_kelamin') }}
                            </th>
                            <th>
                                {{ trans('cruds.mahasiswa.fields.prodi') }}
                            </th>
                            <th>
                                {{ trans('cruds.mahasiswa.fields.periode') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $key => $mahasiswa)
                            <tr data-entry-id="{{ $mahasiswa->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $mahasiswa->id ?? '' }}
                                </td>
                                <td>
                                    {{ $mahasiswa->nama_lengkap ?? '' }}
                                </td>
                                <td>
                                    {{ $mahasiswa->nim ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Mahasiswa::JENIS_KELAMIN_RADIO[$mahasiswa->jenis_kelamin] ?? '' }}
                                </td>
                                <td>
                                    {{ $mahasiswa->prodi->nama_prodi ?? '' }}
                                </td>
                                <td>
                                    {{ $mahasiswa->periode->tahun_periode ?? '' }}
                                </td>
                                <td>
                                    @can('mahasiswa_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.mahasiswas.show', $mahasiswa->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('mahasiswa_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.mahasiswas.edit', $mahasiswa->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('mahasiswa_delete')
                                        <form id="delete-form-{{ $mahasiswa->id }}"
                                            action="{{ route('admin.mahasiswas.destroy', $mahasiswa->id) }}" method="POST"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-xs btn-danger"
                                                onclick="deleteMahasiswa({{ $mahasiswa->id }})">
                                                {{ trans('global.delete') }}
                                            </button>
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Filter Prodi & Tahun Periode dan Program MBKM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.mahasiswa.index') }}" method="post" required>
                    @csrf
                    <div class="modal-body">
                        <label for="prodi">Prodi</label>
                        <select class="form-control {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id" required>
                            @foreach ($prodis as $id => $entry)
                                <option value="{{ $id }}" {{ old('prodi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="tahun_periode">Tahun Periode</label>
                        <select class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" name="periode_id" id="periode_id" required>
                            @foreach ($periodes as $id => $entry)
                                <option value="{{ $id }}" {{ old('periode_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="program">Program</label>
                        <select class="form-control {{ $errors->has('program') ? 'is-invalid' : '' }}" name="program_id" id="program_id" required>
                            @foreach ($programs as $id => $entry)
                                <option value="{{ $id }}" {{ old('program_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-flat btn-primary">Ubah prodi</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}
@endsection
@section('scripts')
    <script>
        function deleteMahasiswa(mahasiswaId) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "data tidak akan bisa di kembalikan!",
                icon: 'warning',
                confirmButtonText: 'Iya, hapus!',
                showDenyButton: true,
                denyButtonText: `Tidak, batal!`,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // jika pengguna menekan tombol "Yes, delete it!", submit form
                    document.getElementById('delete-form-' + mahasiswaId).submit();
                    Swal.fire('Tersimpan!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Perubahan tidak di simpan', '', 'info')
                }
            });
        }
    </script>
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('mahasiswa_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.mahasiswas.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Mahasiswa:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
