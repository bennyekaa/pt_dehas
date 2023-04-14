<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanjirBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'data_banjir';
    //---Set Primary Key---
    protected $primaryKey = 'id_banjir';

    public $incrementing = false;

    public function user()
    {
        return $this->hasOne('App\user');
    }
}
