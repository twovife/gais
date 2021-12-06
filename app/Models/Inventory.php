<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

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
