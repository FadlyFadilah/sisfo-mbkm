<table>
    <tr>
        <th style="font-weight: bold;">Tahun Akademik : {{ $tahunn }}</th>
    </tr>
    <tr>
        <th style="font-weight: bold;">Program Studi  : {{ $prodii }}</th>
    </tr>
    <thead>
        <tr>
            <th style="font-weight: bold; text-align: center">NO</th>
            <th style="font-weight: bold; text-align: center">Nama</th>
            <th style="font-weight: bold; text-align: center">NIM</th>
            <th style="font-weight: bold; text-align: center">Program Studi</th>
            <th style="font-weight: bold; text-align: center">Program MBKM yang di ikuti</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($mahasiswas as $t)
            <tr>
                <td>
                    {{ $no++ }}
                </td>
                <td>{{ $t->nama_lengkap }}</td>
                <td>{{ $t->nim }}</td>
                <td>{{ $t->prodi->nama_prodi }}</td>
                <td>
                    @foreach ($t->mahasiswaPengajuans as $pengajuan)
                        {{ $pengajuan->program->nama_program }},
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
