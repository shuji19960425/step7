<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Companies;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $companies = Companies::all();

        $search = $request->input('search');
        if (is_numeric($request->makerSearch)) {
            $makerSearch = $request->input('makerSearch');
        }

        if (!empty($search)) {
            $products = Products::select([
                'p.id',
                'p.company_id',
                'p.product_name',
                'p.price',
                'p.stock',
                'p.comment',
                'p.img_path',
                'c.company_name',
            ])
            ->from('products as p')
            ->join('companies as c',function($join) {
                $join->on('p.company_id', '=', 'c.id');
            })
            ->where('p.product_name', 'like', '%'.$search.'%')
            ->get();
            
        }elseif (!empty($makerSearch)) {
            $products = Products::select([
                'p.id',
                'p.company_id',
                'p.product_name',
                'p.price',
                'p.stock',
                'p.comment',
                'p.img_path',
                'c.company_name',
            ])
            ->from('products as p')
            ->join('companies as c',function($join) {
                $join->on('p.company_id', '=', 'c.id');
            })
            ->where('p.company_id', $makerSearch)
            ->get();
        }else {
            $products = Products::select([
                'p.id',
                'p.company_id',
                'p.product_name',
                'p.price',
                'p.stock',
                'p.comment',
                'p.img_path',
                'c.company_name',
            ])
            ->from('products as p')
            ->join('companies as c',function($join) {
                $join->on('p.company_id', '=', 'c.id');
            })->get();    
        }
        return view('products.index', compact('products', 'companies', 'search'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::all();
        return view('products.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate ([
            'product_name' => 'required | max:255',
            'maker' => 'required | integer',
            'price' => 'required | integer',
            'stock' => 'required | integer',
            'image' => 'image'
        ]);

        $product = new Products();
        $product->company_id = $request->maker;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        if (request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $product->img_path = $name;
        }
        $product->save();
        return redirect()->route('product.create')->with('message', '登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        $companies = companies::all();
        return view('products.show', compact('product', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $companies = Companies::all();
        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $inputs = $request->validate ([
            'product_name' => 'required | max:255',
            'maker' => 'required | integer',
            'price' => 'required | integer',
            'stock' => 'required | integer',
        ]);

        $product->company_id = $request->maker;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        if (request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image')->move('storage/images', $name);
            $product->img_path = $name;
        }
        $product->save();
        return redirect()->route('product.edit', $product)->with('message', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('message', '商品を削除しました');
    }

}
