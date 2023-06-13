<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryPatchRequest;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Category/Index', [
            'categories' => CategoryResource::collection(Category::paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return inertia()->render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::make($request->validated());

        $category->save();

        return redirect(route('categories'))->with('message', [
            'body' => 'Prodavnica kreirana',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return inertia()->render('Category/Edit', [
            'category' => new CategoryResource(Category::findOrFail($category->id)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryPatchRequest $request, Category $category)
    {
        $category->update($request->validated());
    
        return redirect(route('categories'))->with('message', [
            'body' => 'Kategorija izmenjena',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(route('categories'))->with('message', [
            'body' => 'Kategorija izbrisana',
            'type' => 'success'
        ]);
    }
}
