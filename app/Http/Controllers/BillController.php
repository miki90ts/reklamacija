<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Http\Resources\BillResource;

class BillController extends Controller
{
    protected const BILLS_PER_PAGE = 5;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Dashboard', [
           
            'bills' => BillResource::collection(
                Bill::whereBelongsTo(auth()->user())
                    ->with(['store', 'product.category'])
                    ->oldest()
                    ->paginate(self::BILLS_PER_PAGE)
            ),
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
