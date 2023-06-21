<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\Periode;
use App\Models\Prodi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class TiExport implements FromView, ShouldAutoSize
{
    protected $prodi;
    protected $tahun;
    protected $program;

    public function __construct($prodi, $tahun, $program)
    {
        $this->prodi = $prodi;
        $this->tahun = $tahun;
        $this->program = $program;
    }
    public function view(): View
    {
        if ($this->tahun) {
            $tahun = Periode::find($this->tahun);
            $tahunn = $tahun->tahun_periode;
        }else {
            $tahun = Periode::where('status', 'Aktif')->first();
            $tahunn = $tahun->tahun_periode;
        }
        if ($this->prodi) {
            $prodi = Prodi::find($this->prodi);
            $prodii = $prodi->nama_prodi;
        }else {
            $prodii = '-';
        }
        $mahasiswas = Mahasiswa::with('user', 'mahasiswaPengajuans.program')
            ->when($this->prodi, function ($query) {
                return $query->where('prodi_id', $this->prodi);
            })
            ->when($this->tahun, function ($query) {
                return $query->where('periode_id', $this->tahun);
            })
            ->when($this->program, function ($query) {
                return $query->whereHas('mahasiswaPengajuans.program', function ($q) {
                    $q->where('id', $this->program);
                });
            })
            ->get();
        return view('exports.Exports', compact('mahasiswas', 'tahunn', 'prodii'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getFont()->setBold('true');
                $event->sheet->insertImage('A1', public_path('LOGOTEDC.PNG'));
            },
        ];
    }
}
