<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function outcome_detail()
    {
        return $this->hasMany(Outcome_detail::class);
    }

    function hc_rank_ga_structure()
    {
        return $this->belongsTo(Hc_rank_ga_structure::class, 'struktur_id', 'id');
    }

    // relasi tabel untuk pembuatan API BKB 
}
