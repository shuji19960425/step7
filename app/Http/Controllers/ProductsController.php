<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $model = new companies();
        $companies = $model->companies();

        $search = $request->input('search');
        if (is_numeric($request->makerSearch)) {
            $makerSearch = $request->input('makerSearch');
        }

        $productsModel = new Products();

        if (!empty($search)) {
            $products = $productsModel->productsSearch($search);
            
        }elseif (!empty($makerSearch)) {
            $products = $productsModel->makerSearch($makerSearch);

        }else {
            $products = $productsModel->products();    

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
        $model = new companies();
        $companies = $model->companies();
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
        try {
            DB::beginTransaction();

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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    
        
        return redirect()->route('product.create')->with('message', config('session.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        $model = new companies();
        $companies = $model->companies();
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
        $model = new companies();
        $companies = $model->companies();
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

        try {
            DB::beginTransaction();

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

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            Log::error($e);
        }

        return redirect()->route('product.edit', $product)->with('message', config('session.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();
        } catch(\Expention $e) {
            DB::rollback();
            Log::error($e);
        }
        
        return redirect()->route('product.index')->with('message', config('session.delete'));
    }

}
