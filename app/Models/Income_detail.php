<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income_detail extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class)->withTrashed();
    }

    public function income()
    {
        return $this->belongsTo(Income::class);
    }
}
