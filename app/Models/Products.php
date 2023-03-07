<?php

namespace App\Models;

use App\Models\Companies;
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

    public function productsSearch($search) {
            $productsSearch = Products::where('product_name', 'like', '%'.$search.'%')->get();
            return $productsSearch;
    }

    public function products() {
        $products = Products::all();
        return $products;
    }

    public function makerSearch($makerSearch) {
        $makerSearch = Products::where('company_id', 'like', '%'.$makerSearch.'%')->get();
        return $makerSearch;
    }
}
