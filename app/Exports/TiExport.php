<?php

namespace App\Exports;

use App\Models\Mahasiswa;
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
        if ($this->prodi && $this->tahun && $this->program) {
            $program = $this->program;
            $mahasiswas = Mahasiswa::with('user')->where('prodi_id', $this->prodi)->where('periode_id', $this->tahun)->whereHas('mahasiswaPengajuans.program', function ($query) use ($program) {
                $query->where('id', $program);
            })->get();
            return view('exports.Exports', compact('mahasiswas'));
        } elseif ($this->prodi && $this->tahun) {
            $mahasiswas = Mahasiswa::with('user')->where('prodi_id', $this->prodi)->where('periode_id', $this->tahun)->get();
            return view('admin.mahasiswas.index', compact('mahasiswas'));
        } elseif ($this->tahun && $this->program) {
            $program = $this->program;
            $mahasiswas = Mahasiswa::with('user')->where('periode_id', $this->tahun)->whereHas('mahasiswaPengajuans.program', function ($query) use ($program){
                $query->where('id', $program);
            })->get();
            return view('admin.mahasiswas.index', compact('mahasiswas'));
        } elseif ($this->prodi) {
            $mahasiswas = Mahasiswa::with('user')->where('prodi_id', $this->prodi)->get();
            return view('exports.Exports', compact('mahasiswas'));
        } elseif ($this->tahun) {
            $mahasiswas = Mahasiswa::with('user')->where('periode_id', $this->tahun)->get();
            return view('exports.Exports', compact('mahasiswas'));
        } elseif ($this->program) {
            $program = $this->program;
            $mahasiswas = Mahasiswa::with('user', 'mahasiswaPengajuans.program')->whereHas('mahasiswaPengajuans.program', function ($query) use ($program) {
                $query->where('id', $program);
            })->get();
            return view('exports.Exports', compact('mahasiswas'));
        }
        $mahasiswas = Mahasiswa::with('mahasiswaPengajuans')->get();
        return view('exports.Exports', compact('mahasiswas'));
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
