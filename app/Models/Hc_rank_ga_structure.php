<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class Hc_rank_ga_structure extends Model
{
    use HasFactory;

    public function hc_unit()
    {
        return $this->belongsTo(Hc_unit::class, 'unit_id', 'id');
    }

    public function hc_sub_unit()
    {
        return $this->belongsTo(Hc_sub_unit::class, 'sub_unit_id', 'id');
    }
}
