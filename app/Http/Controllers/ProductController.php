<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,Category};
use App\Http\Resources\{ProductResource,CategoryResource};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Product/Index', [
            'products' => ProductResource::collection(Product::with(['category'])->get()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Product/Create',[
            'categories' => CategoryResource::collection(Category::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $product = new Product(['title' => $request->title]);

        // $category = Category::find($request->category_id);
 
        // $category->products()->save($product);

        $product = Category::find($request->category_id)
        ->products()
        ->create(['title' => $request->title]);
       
        return redirect(route('products'))->with('message', [
            'body' => 'Produkt kreiran',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('products'))->with('message', [
            'body' => 'Produkt izbrisan',
            'type' => 'success'
        ]);
    }
}
