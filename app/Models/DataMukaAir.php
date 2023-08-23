<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMukaAir extends Model
{
    protected $connection = 'mysql';
    protected $table = 'data_banjir_muka_air';
    //---Set Primary Key---
    protected $primaryKey = 'id_banjir_muka_air';

    public $incrementing = false;

    public function role()
    {
        return $this->belongsTo(Role::class, "id_role", "id_role");
    }

    public function peta()
    {
        return $this->belongsTo(peta::class, "id_peta", "id_peta");
    }
}
