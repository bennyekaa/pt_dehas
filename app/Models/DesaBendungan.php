<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_desa';
    //---Set Primary Key---
    protected $primaryKey = 'id_desa';

    public $incrementing = false;

    protected $fillable = [
        'id_desa',
        'kode_pengungsian',
        'desa',
        'titik_kumpul',
        'jarak_titik_kumpul',
        'tk_x',
        'tk_y',
        'lokasi_pengungsian',
        'jarak_pengungsian',
        'p_x',
        'p_y',
        'e_x',
        'e_y',
        'created_at',
        'created_by'
    ];
}
