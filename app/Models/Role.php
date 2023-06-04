<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_role';
    protected $primaryKey = 'id_role';

    public $incrementing = false;

    public function log()
    {
        return $this->hasMany(Log::class, "id_log", "id_log");
    }
}
