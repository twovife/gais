<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'id', 'inventory_id');
    }
}