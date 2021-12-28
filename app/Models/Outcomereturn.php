<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcomereturn extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function outcome_detail()
    {
        return $this->belongsTo(Outcome_detail::class);
    }

    public function outcome()
    {
        return $this->belongsTo(Outcome::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class)->withTrashed();
    }
}
