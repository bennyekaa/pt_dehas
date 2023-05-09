<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanjirBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'data_banjir_muka_air';
    //---Set Primary Key---
    protected $primaryKey = 'id_banjir_muka_air';

    public $incrementing = false;

    public function user()
    {
        return $this->hasOne('App\user');
    }
}
