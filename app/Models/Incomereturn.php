<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomereturn extends Model
{
    use HasFactory;

    public function income_detail()
    {
        return $this->belongsTo(Income_detail::class);
    }

    public function income()
    {
        return $this->belongsTo(Income::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class)->withTrashed();
    }
}
