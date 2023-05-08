<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class DesaBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_desa';
    protected $primaryKey = 'id_desa';

    public $incrementing = false;

    protected $fillable = [
        'id_desa',
        'id_pengungsian',
        'id_titik_kumpul',
        'kode_desa',
        'desa_lat',
        'desa_long',
        'kelurahan_desa',
        'kecamatan_desa',
        'kabupaten_desa',
        'jarak_dari_bendungan',
        'banjir',
        'kec_max',
        'waktu_tiba',
        'waktu_surut',
        'durasi_banjir',
        'jumlah_jiwa',
        'jumlah_kk',
        'rendah',
        'sedang',
        'tinggi',
        'total',
        'kk',
        'tidak_terdampak',
        'zona_bahaya',
        'balita',
        'anak',
        'muda',
        'dewasa',
        'manula',
        'total_jiwa',
        'laki_laki',
        'perempuan',
        'total_LP',
        'created_at',
        'created_by'
    ];
}
