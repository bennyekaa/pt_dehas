<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendukung extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'data_pendukung';
    protected $primaryKey = 'id';

    public $incrementing = false;
}
