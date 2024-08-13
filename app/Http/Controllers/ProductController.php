<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
        // $fBusiness = ($request->bsn > ' ') ? $request->bsn : '';
        // if(auth()->user()->role == 'admin'){
        //     $products = Product::select('products.*', 'bsn_title')
        //         ->join('businesses', 'businesses.id', '=', 'products.prd_business')
        //         ->get();
        // } else {
        //     $products = Product::select('products.*', 'bsn_title')
        //         ->join('businesses', 'businesses.id', '=', 'products.prd_business')
        //         ->where('bsn_socio','=', auth()->user()->id)
        //         ->where('prd_business','=', $fBusiness)
        //         ->get();
        // }
        // dd($request);
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProductRequest $request)
    {
        $product = new Product;
        $prdSave = $request->validated();

        // return $request->prd_picture;

        $prdSave['prd_picture'] = '';
        $product->create($prdSave);
        
        $pIdn = Product::latest('id')->first()->id;
        $bpId = strval($request->prd_business);
        // return $bpId;
        $pId = str_pad($bpId,3,'0',STR_PAD_LEFT).str_pad($pIdn,3,'0',STR_PAD_LEFT).'.png';
        $file = $request->prd_picture;
        if(strlen($file) > 15){
            $file = substr($file, strpos($file, ',') + 1);
            Storage::put($pId, base64_decode($file));
        }
        $prdSave['prd_picture'] = $pId;
        $product = Product::find($pIdn);
        $product->update($prdSave);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveProductRequest $request, Product $product)
    {
        $pId = strval($product->id);
        $bpId = strval($product->prd_business);
        $pId = str_pad($bpId,3,'0',STR_PAD_LEFT).str_pad($pId,3,'0',STR_PAD_LEFT).'.png';
        $file = $request->prd_picture;
        if(strlen($file) > 15){
            $file = substr($file, strpos($file, ',') + 1);
            Storage::put($pId, base64_decode($file));   
        }
        $prdSave = $request->all();
        $prdSave['prd_picture'] = $pId;

        $product->update($prdSave);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
