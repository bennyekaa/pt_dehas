<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class TitikKumpulBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_titik_kumpul';
    protected $primaryKey = 'id_titik_kumpul';

    public $incrementing = false;

    protected $fillable = [
        'id_titik_kumpul',
        'kode_tk',
        'tk_lat',
        'tk_long',
        'nama_titik_kumpul',
        'nama_desa',
        'nama_kecamatan',
        'nama_kabupaten',
        'jarak_ke_tk',
        'created_at',
        'created_by'
    ];
}
