<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryPatchRequest;
use App\Http\Requests\CategoryStoreRequest;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'kategorije');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Category/Index', [
            'kategorije' => CategoryResource::collection(Category::paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());

        return redirect(route('kategorije'))->with('message', [
            'body' => 'Prodavnica kreirana',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Logic for showing a specific category if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', [
            'category' => new CategoryResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryPatchRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect(route('kategorije'))->with('message', [
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

        return redirect(route('kategorije'))->with('message', [
            'body' => 'Kategorija izbrisana',
            'type' => 'success'
        ]);
    }
}
