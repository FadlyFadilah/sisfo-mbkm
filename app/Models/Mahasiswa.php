<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'mahasiswas';

    protected $dates = [
        'tanggal_lahir',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const JENIS_KELAMIN_RADIO = [
        'laki-laki' => 'Laki-Laki',
        'perempuan' => 'Perempuan',
    ];

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nim',
        'prodi_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'periode_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function mahasiswaPengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'mahasiswa_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function getTanggalLahirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
    public function pengajuanByProdi($prodi)
    {
        return $this->mahasiswaPengajuans()->where('prodi', $prodi)->count();
    }

    public function laporans()
    {
        return $this->hasManyThrough(Laporan::class, Pengajuan::class);
    }
}
