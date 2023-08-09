<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\{StoreCategoryRequest,UpdateCategoryRequest};

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
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();
      
        if (!Storage::exists('public/svg/' . $validatedData['icon_name'] . '.svg')) {
            $validatedData['icon']->storeAs('public/svg', $validatedData['icon_name'] . '.svg');
        }
     
        $category = Category::create([
            'title' => $validatedData['title'],
            'icon' => $validatedData['icon_name']
        ]);
        
        return redirect(route('kategorije'))->with('message', [
            'body' => 'Kategorija kreirana',
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();
      
        $iconName = $category->icon;
      
        if(array_key_exists('icon' ,$validatedData)){
            if (Storage::exists('public/svg/' . $iconName . '.svg')) {
                Storage::delete('public/svg/'. $iconName . '.svg');
            }
            
            if (!Storage::exists('public/svg/' . $validatedData['icon_name'] . '.svg')) {
                $validatedData['icon']->storeAs('public/svg', $validatedData['icon_name'] . '.svg');
            }
        }
      
        $category->update([
            'title' => $validatedData['title'],
            'icon' => $validatedData['icon_name']
        ]);

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
        if (Storage::exists('public/svg/' . $category->icon . '.svg')) {
            Storage::delete('public/svg/'. $category->icon . '.svg');
        }

        $category->delete();

        return redirect(route('kategorije'))->with('message', [
            'body' => 'Kategorija izbrisana',
            'type' => 'success'
        ]);
    }
}
