<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web_custom extends Model
{
    // protected $connection = 'pgsql';
    protected $table = 'ref_web';
    //---Set Primary Key---
    protected $primaryKey = 'id_web';

    public $incrementing = false;
}
