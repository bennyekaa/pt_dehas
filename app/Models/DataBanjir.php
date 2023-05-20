<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBanjir extends Model
{
    protected $connection = 'mysql';
    protected $table = 'data_banjir_bocor';
    //---Set Primary Key---
    protected $primaryKey = 'id_banjir_bocor';

    public $incrementing = false;

    public function statusbocor()
    {
        return $this->belongsTo(StatusBocor::class, "id_status_bocor", "id_status_bocor");
    }
}
