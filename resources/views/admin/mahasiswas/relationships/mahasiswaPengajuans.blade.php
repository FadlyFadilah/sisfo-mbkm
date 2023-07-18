<div class="m-3">
    @can('pengajuan_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.pengajuans.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.pengajuan.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.pengajuan.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-mahasiswaPengajuans">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.pengajuan.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.pengajuan.fields.mahasiswa') }}
                            </th>
                            <th>
                                {{ trans('cruds.pengajuan.fields.program') }}
                            </th>
                            <th>
                                {{ trans('cruds.pengajuan.fields.semester') }}
                            </th>
                            <th>
                                {{ trans('cruds.pengajuan.fields.no_hp') }}
                            </th>
                            <th>
                                Verifikasi
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuans as $key => $pengajuan)
                            <tr data-entry-id="{{ $pengajuan->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $pengajuan->id ?? '' }}
                                </td>
                                <td>
                                    {{ $pengajuan->mahasiswa->nama_lengkap ?? '' }}
                                </td>
                                <td>
                                    {{ $pengajuan->program->nama_program ?? '' }}
                                </td>
                                <td>
                                    {{ $pengajuan->semester ?? '' }}
                                </td>
                                <td>
                                    {{ $pengajuan->no_hp ?? '' }}
                                </td>
                                <td>
                                    {{ $pengajuan->verif ?? '' }}
                                </td>
                                <td>
                                    @can('pengajuan_edit')
                                        <form id="verif-form-{{ $pengajuan->id }}"
                                            action="{{ route('admin.pengajuans.verif', $pengajuan->id) }}" method="POST"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="PATCH">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="verif" value="Verifikasi">
                                            <button type="button" class="btn btn-xs btn-success"
                                                onclick="pengajuanVerif({{ $pengajuan->id }})">
                                                Verif
                                            </button>
                                        </form>

                                        <form id="tolak-form-{{ $pengajuan->id }}"
                                            action="{{ route('admin.pengajuans.verif', $pengajuan->id) }}" method="POST"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="PATCH">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="verif" value="Tolak">
                                            <button type="button" class="btn btn-xs btn-warning"
                                                onclick="pengajuanTolak({{ $pengajuan->id }})">
                                                Tolak
                                            </button>
                                        </form>
                                    @endcan

                                    @can('pengajuan_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.pengajuans.show', $pengajuan->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    {{-- <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.pengajuans.edit', $pengajuan->id) }}">
                                            {{ trans('global.edit') }}
                                        </a> --}}

                                    @can('pengajuan_delete')
                                        <form id="delete-form-{{ $pengajuan->id }}"
                                            action="{{ route('admin.pengajuans.destroy', $pengajuan->id) }}" method="POST"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-xs btn-danger"
                                                onclick="deletePengajuan({{ $pengajuan->id }})">
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
</div>
@section('scripts')
    @parent
    <script>
        function deletePengajuan(pengajuanId) {
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
                    document.getElementById('delete-form-' + pengajuanId).submit();
                    Swal.fire('Tersimpan!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Perubahan tidak di simpan', '', 'info')
                }
            });
        }
    </script>
    <script>
        function pengajuanVerif(pengajuanId) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Verifikasi Pengajuan ini!",
                icon: 'warning',
                confirmButtonText: 'Iya, Verifikasi!',
                showDenyButton: true,
                denyButtonText: `Tidak, batal!`,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // jika pengguna menekan tombol "Yes, delete it!", submit form
                    document.getElementById('verif-form-' + pengajuanId).submit();
                    Swal.fire('Tersimpan!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Perubahan tidak di simpan', '', 'info')
                }
            });
        }
    </script>
    <script>
        function pengajuanTolak(pengajuanId) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Tolak Pengajuan ini!",
                icon: 'warning',
                confirmButtonText: 'Iya, Tolak!',
                showDenyButton: true,
                denyButtonText: `Tidak, batal!`,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // jika pengguna menekan tombol "Yes, delete it!", submit form
                    document.getElementById('tolak-form-' + pengajuanId).submit();
                    Swal.fire('Tersimpan!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Perubahan tidak di simpan', '', 'info')
                }
            });
        }
    </script>
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('pengajuan_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.pengajuans.massDestroy') }}",
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
            let table = $('.datatable-mahasiswaPengajuans:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
