<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\{Brand,Category};
use App\Http\Controllers\Controller;
use App\Http\Resources\{BrandResource, CategoryResource};
use App\Http\Requests\{StoreBrandRequest, UpdateBrandRequest};

class BrandController extends Controller
{
    /**
     * Create the controller instance.
    */
    public function __construct()
    {
        $this->authorizeResource(Brand::class, 'brand');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Brand/Index', [
            'brands' => BrandResource::collection(Brand::with(['category'])->paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Brand/Create',[
            'categories' => CategoryResource::collection(Category::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $validatedData = $request->validated();
    
        Category::find($validatedData['category_id'])
            ->brands()
            ->create($validatedData);
       
        return redirect(route('brands'))->with('message', [
            'body' => 'Brand kreiran',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return inertia()->render('Brand/Edit', [
            'brand' => new BrandResource(Brand::with(['category'])->findOrFail($brand->id)),
            'categories' => CategoryResource::collection(Category::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $validatedData = $request->validated();
    
        $brand->update($validatedData);
       
        return redirect(route('brands'))->with('message', [
            'body' => 'Brend izmenjen',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect(route('brands'))->with('message', [
            'body' => 'Brend izbrisan',
            'type' => 'success'
        ]);
    }
}
