<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id')->withTrashed();
    }

    public function income_detail()
    {
        return $this->hasMany(Income_detail::class);
    }
}
