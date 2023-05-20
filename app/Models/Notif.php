<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $connection = 'mysql';
    protected $table = 'notif';
    protected $primaryKey = 'id';

    public $incrementing = false;
}
