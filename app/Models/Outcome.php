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

    // relasi tabel untuk pembuatan API BKB 
}
