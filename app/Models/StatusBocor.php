<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBocor extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_status_bocor';
    protected $primaryKey = 'id_status_bocor';

    public $incrementing = false;

    public function kategoriBocor()
    {
        return $this->belongsTo(KategoriBocor::class, "id_kategori_bocor", "id_kategori_bocor");
    }
}
