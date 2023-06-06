<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Resources\StoreResource;
use App\Http\Requests\StorePatchRequest;
use App\Http\Requests\StoreStoreRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Store/Index', [
            'stores' => StoreResource::collection(Store::paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Store/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        Store::create($request->validated());

        return redirect(route('stores'))->with('message', [
            'body' => 'Prodavnica kreirana',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        return inertia()->render('Store/Edit', [
            'store' => new StoreResource(Store::findOrFail($store->id)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePatchRequest $request, Store $store)
    {
        $store->update($request->validated());
    
        return redirect(route('stores'))->with('message', [
            'body' => 'Prodavnica izmenjena',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect(route('stores'))->with('message', [
            'body' => 'Prodavnica izbrisana',
            'type' => 'success'
        ]);
    }
}
