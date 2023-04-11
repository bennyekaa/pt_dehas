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
}
