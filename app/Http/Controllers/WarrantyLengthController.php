<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WarrantyLength;
use App\Http\Resources\WarrantyLengthResource;
use App\Http\Requests\WarrantyLengthPatchRequest;
use App\Http\Requests\WarrantyLengthStoreRequest;

class WarrantyLengthController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(WarrantyLength::class, 'warrantyLength');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('WarrantyLength/Index', [
            'warrantyLengths' => WarrantyLengthResource::collection(WarrantyLength::paginate(10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('WarrantyLength/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarrantyLengthStoreRequest $request)
    {
        WarrantyLength::create($request->validated());

        return redirect(route('warranty_lengths'))->with('message', [
            'body' => 'Dužina garancije kreirana',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(WarrantyLength $warrantyLength)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WarrantyLength $warrantyLength)
    {
        return inertia()->render('WarrantyLength/Edit', [
            'warrantyLength' => new WarrantyLengthResource(WarrantyLength::findOrFail($warrantyLength->id)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarrantyLengthPatchRequest $request, WarrantyLength $warrantyLength)
    {
        $warrantyLength->update($request->validated());
    
        return redirect(route('warranty_lengths'))->with('message', [
            'body' => 'Dužina garancije izmenjena',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WarrantyLength $warrantyLength)
    {
        $warrantyLength->delete();

        return redirect(route('warranty_lengths'))->with('message', [
            'body' => 'Dužina garancije izbrisana',
            'type' => 'success'
        ]);
    }
}
