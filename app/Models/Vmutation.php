<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vmutation extends Model
{
    use HasFactory;

    public function vincome()
    {
        return $this->belongsTo(Vincome::class);
    }
    public function voutcome()
    {
        return $this->belongsTo(Voutcome::class);
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class)->withTrashed();
    }

    public function incomereturn()
    {
        return $this->belongsTo(Incomereturn::class);
    }

    public function getRouteKeyName()
    {
        return 'inventory_id';
    }
}
