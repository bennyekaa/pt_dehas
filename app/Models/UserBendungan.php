<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBendungan extends Model
{
    // protected $connection = 'simpegabaru';
    protected $table = 'ref_user';
    //---Set Primary Key---
    protected $primaryKey = 'id_user';

    public $incrementing = false;
}
