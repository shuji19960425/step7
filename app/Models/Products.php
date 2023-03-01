<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    public function company() {
        return $this->belongsTo(Companies::class);
    }

    public function sales() {
        return $this->hasMany(Sales::class);
    }
}
