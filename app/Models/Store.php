<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function vstore()
    {
        return $this->hasOne(Vstore::class, 'id', 'id');
    }
    // public function getRouteKeyName()
    // {
    //     return 'id';
    // }
}
