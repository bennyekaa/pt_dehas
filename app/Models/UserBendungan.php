<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBendungan extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ref_user';
    //---Set Primary Key---
    protected $primaryKey = 'id_user';

    public $incrementing = false;

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'hp',
        'username',
        'password',
        'id_role',
        'id_desa',
        'created_at',
        'created_by'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, "id_role", "id_role");
    }
}
