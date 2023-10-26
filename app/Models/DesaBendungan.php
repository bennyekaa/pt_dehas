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
        'radius',
        'kelurahan_desa',
        'kecamatan_desa',
        'kabupaten_desa',
        'jarak_dari_bendungan',
        'zona_bahaya',
        'id_kategori',
        'bendungan',
        'created_at',
        'created_by'
    ];
}
