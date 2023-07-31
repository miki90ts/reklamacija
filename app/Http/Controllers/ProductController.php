<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,Brand};
use App\Http\Resources\{ProductResource,BrandResource};
use App\Http\Requests\{UpdateProductRequest,StoreProductRequest};

class ProductController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Product/Index', [
            'products' => ProductResource::collection(Product::with(['brand'])->paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Product/Create',[
            'brands' => BrandResource::collection(Brand::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
    
        Brand::find($validatedData['brand_id'])
            ->products()
            ->create($validatedData);
       
        return redirect(route('proizvodi'))->with('message', [
            'body' => 'Proizvod kreiran',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return inertia()->render('Product/Edit', [
            'product' => new ProductResource(Product::with(['brand'])->findOrFail($product->id)),
            'brands' => BrandResource::collection(Brand::all()),
            //'product' => $product, jedan kveri manje implicit modal biding 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
    
        $product->update($validatedData);
       
        return redirect(route('proizvodi'))->with('message', [
            'body' => 'Proizvod izmenjen',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('proizvodi'))->with('message', [
            'body' => 'Proizvod izbrisan',
            'type' => 'success'
        ]);
    }
}
