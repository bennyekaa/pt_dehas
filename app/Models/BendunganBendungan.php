<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BendunganBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_bendungan';
    //---Set Primary Key---
    protected $primaryKey = 'id_bendungan';

    public $incrementing = false;


}
