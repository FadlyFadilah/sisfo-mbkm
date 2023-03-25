<table>
    <thead>
        <tr>
            <th style="font-weight: bold; text-align: center">Nama</th>
            <th style="font-weight: bold; text-align: center">NIM</th>
            <th style="font-weight: bold; text-align: center">Program Studi</th>
            <th style="font-weight: bold; text-align: center">Program MBKM yang di ikuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswas as $t)
            <tr>
                <td>{{ $t->nama_lengkap }}</td>
                <td>{{ $t->nim }}</td>
                <td>{{ $t->prodi }}</td>
                <td>
                    @foreach ($t->mahasiswaPengajuans as $pengajuan)
                        {{ $pengajuan->program->nama_program }},
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
