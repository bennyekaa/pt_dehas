<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBocor extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_kategori_bocor';
    protected $primaryKey = 'id_kategori_bocor';

    public $incrementing = false;

    // public function namakategori()
    // {
    //     return $this->belongsTo(KategoriBocor::class, "id_kategori_bocor", "id_kategori_bocor");
    // }
}
