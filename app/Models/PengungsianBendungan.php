<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class PengungsianBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_pengungsian';
    protected $primaryKey = 'id_pengungsian';

    public $incrementing = false;

    protected $fillable = [
        'id_pengungsian',
        'kode_pengungsian',
        'pengungsian_lat',
        'pengungsian_long',
        'nama_pengungsian',
        'nama_desa_pengungsian',
        'nama_kecamatan_pengungsian',
        'nama_kabupaten_pengungsian',
        'jarak_pengungsian',
        'created_at',
        'created_by'
    ];
}
