<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;

    public function products() {
        return $this->hasMany(Products::class);
    }

    public function companies() {
        $companies = Companies::all();
        return $companies;
    }

    public function makerSearch($makerSearch) {
        $makerSearch = Companies::where('company_name', 'like', '%'.$makerSearch.'%')->get();
        return $makerSearch;
    }
}
