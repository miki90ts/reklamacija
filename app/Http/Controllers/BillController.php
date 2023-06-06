<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\BillStoreRequest;
use App\Models\{Bill,Store,Category,Product,WarrantyLength};
use App\Http\Resources\{BillResource,StoreResource,CategoryResource,ProductResource,WarrantyLengthResource};

class BillController extends Controller
{
    protected const BILLS_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Bill/Index', [
           
            'bills' => BillResource::collection(
                Bill::whereBelongsTo(auth()->user())
                    ->with(['store', 'product.category','warrantyLength'])
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
        return inertia()->render('Bill/Create',[
            'categories' => CategoryResource::collection(Category::all()),
            'stores' => StoreResource::collection(Store::all()),
            'products' => ProductResource::collection(Product::all()),
            'warrantyLengths' => WarrantyLengthResource::collection(WarrantyLength::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BillStoreRequest $request)
    {
        $validatedData = $request->validated();
      
        $photo = $validatedData['photo']->store('public/bills');
      
        $bill = new Bill();

        $bill->user_id = auth()->user()->id;
        $bill->product_id = $validatedData['product_id'];
        $bill->store_id = $validatedData['store_id'];
        $bill->purchased_at = Carbon::parse($validatedData['purchased_at'])->format('Y-m-d');
        $bill->photo = basename($photo);
        $bill->warranty_length_id = $validatedData['warranty_length_id'];
        
        $bill->save();

        return redirect(route('bills'))->with('message', [
            'body' => 'Račun sačuvan',
            'type' => 'success'
        ]);
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
