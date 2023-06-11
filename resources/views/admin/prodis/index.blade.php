@extends('layouts.admin')
@section('content')
    @can('prodi_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.prodis.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.prodi.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.prodi.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-hover datatable datatable-Prodi">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.prodi.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.prodi.fields.nama_prodi') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($prodis as $key => $prodi)
                            <tr data-entry-id="{{ $prodi->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $prodi->nama_prodi ?? '' }}
                                </td>
                                <td>
                                    @can('prodi_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.prodis.show', $prodi->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('prodi_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.prodis.edit', $prodi->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('prodi_delete')
                                        <form id="delete-form-{{ $prodi->id }}"
                                            action="{{ route('admin.prodis.destroy', $prodi->id) }}" method="POST"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-xs btn-danger"
                                                onclick="deleteProdi({{ $prodi->id }})">
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
@endsection
@section('scripts')
    @parent
    <script>
        function deleteProdi(prodiId) {
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
                    document.getElementById('delete-form-' + prodiId).submit();
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
            @can('prodi_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.prodis.massDestroy') }}",
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
            let table = $('.datatable-Prodi:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
