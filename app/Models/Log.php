<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'mysql';
    protected $table = 'log';
    protected $primaryKey = 'id_log';

    public $incrementing = false;

    protected $fillable = [
        'mac_add','keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(UserBendungan::class, "id_user", "id_user");
    }
}
