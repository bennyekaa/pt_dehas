<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peta extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'data_peta';
    protected $primaryKey = 'id_peta';

    public $incrementing = false;
}
