<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product,Category};
use App\Http\Requests\{ProductPatchRequest,ProductStoreRequest};
use App\Http\Resources\{ProductResource,CategoryResource};

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
            'products' => ProductResource::collection(Product::with(['category'])->paginate(10)),
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
    public function store(ProductStoreRequest $request)
    {
        $validatedData = $request->validated();
    
        $product = Category::find($validatedData['category_id'])
            ->products()
            ->create(['title' => $validatedData['title']]);
       
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
            'product' => new ProductResource(Product::with(['category'])->findOrFail($product->id)),
            'categories' => CategoryResource::collection(Category::all()),
            //'product' => $product, jedan kveri manje implicit modal biding 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductPatchRequest $request, Product $product)
    {
        $validatedData = $request->validated();
    
        $product->update([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id']
        ]);
       
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
