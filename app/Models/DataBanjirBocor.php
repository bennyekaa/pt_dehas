<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBanjirBocor extends Model
{
    protected $connection = 'mysql';
    protected $table = 'data_banjir_bocor';
    //---Set Primary Key---
    protected $primaryKey = 'id_banjir_bocor';

    public $incrementing = false;

    public function kategoribocor()
    {
        return $this->belongsTo(KategoriBocor::class, "id_kategori_bocor", "id_kategori_bocor");
    }

    public function peta()
    {
        return $this->belongsTo(peta::class, "id_peta", "id_peta");
    }
}
