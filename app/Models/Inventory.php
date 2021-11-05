<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function component_category()
    {
        return $this->belongsTo(Component_category::class);
    }

    public function component_unit()
    {
        return $this->belongsTo(Component_unit::class);
    }

    public function vinventory()
    {
        return $this->hasOne(Vinventory::class, 'id', 'id');
    }
}
