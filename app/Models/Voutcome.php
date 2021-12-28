<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voutcome extends Model
{
    use HasFactory;


    function hc_rank_ga_structure()
    {
        return $this->belongsTo(Hc_rank_ga_structure::class, 'struktur_id', 'id');
    }
}
