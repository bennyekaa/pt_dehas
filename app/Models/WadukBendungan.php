<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WadukBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_waduk';
    //---Set Primary Key---
    protected $primaryKey = 'id_waduk';

    public $incrementing = false;

    protected $fillable = ['id_waduk', 'batas_bawah', 'batas_atas', 'status', 'keterangan', 'puncak', 'ambang', 'lebar', 'c', 'created_by'];
}
