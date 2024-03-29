<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\{StoreBillRequest,UpdateBillRequest};
use App\Models\{Bill,Store,Category,Product,WarrantyLength,Brand};
use App\Http\Resources\{BillResource,StoreResource,CategoryResource,ProductResource,WarrantyLengthResource,BrandResource};

class BillController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Bill::class, 'bill');
    }

    protected const BILLS_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia()->render('Bill/Index', [
            'query' => (object) $request->query(),

            'bills' => BillResource::collection(
                Bill::whereBelongsTo(auth()->user())
                    ->with(['store', 'product.brand.category','warrantyLength'])
                    ->when($request->categories, function ($query) use ($request){
                        $query->whereHas('product.brand.category', function ($query) use ($request) {
                            $query->whereIn('categories.id', explode(',', $request->categories));
                        });
                    })
                    ->when($request->brands, function ($query) use ($request){
                        $query->whereHas('product.brand', function ($query) use ($request) {
                            $query->whereIn('brands.id', explode(',', $request->brands));
                        });
                    })
                    ->when($request->products, function ($query) use ($request){
                        $query->whereHas('product', function ($query) use ($request) {
                            $query->whereIn('products.id', explode(',', $request->products));
                        });
                    })
                    ->when($request->stores, function ($query) use ($request){
                        $query->whereHas('store', function ($query) use ($request) {
                            $query->whereIn('stores.id', explode(',', $request->stores));
                        });
                    })
                    ->when($request->price, function ($query) use ($request){
                        $query->where('price', '>=', explode(',', $request->price)[0])
                            ->where('price', '<=', explode(',', $request->price)[1]);
                    })
                    ->oldest()
                    ->paginate(self::BILLS_PER_PAGE)
                    ->appends($request->query())
            ),

            'prices' => Bill::whereBelongsTo(auth()->user())
                ->selectRaw('MAX(price) as max_price, MIN(price) as min_price')
                ->first(),

            'categories' => Category::whereHas('brands.products.bills.user', function ($query) {
                $query->where('id', auth()->id());
            })
                ->distinct()
                ->get(['id','title']),

            'brands' => Brand::whereHas('products.bills.user', function ($query) {
                $query->where('id', auth()->id());
            })
                ->distinct()
                ->get(['id','title']),

            'stores' => Store::whereHas('bills.user', function ($query) {
                $query->where('id', auth()->id());
            })
                ->distinct()
                ->get(['id','title']),

            'products' => Product::whereHas('bills.user', function ($query) {
                $query->where('id', auth()->id());
            })
                ->distinct()
                ->get(['id','title']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Bill/Create',[
            'categories' => CategoryResource::collection(Category::all()),
            'brands' => BrandResource::collection(Brand::all()),
            'stores' => StoreResource::collection(Store::all()),
            'products' => ProductResource::collection(Product::all()),
            'warrantyLengths' => WarrantyLengthResource::collection(WarrantyLength::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillRequest $request)
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
        $bill->price = $validatedData['price'];
        $bill->note = $validatedData['note'];
        
        $bill->save();

        return redirect(route('racuni'))->with('message', [
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
        return inertia()->render('Bill/Edit', [
            'bill' => Bill::with('product.brand.category')->findOrFail($bill->id),
            //'category' => Category::findOrFail($bill->product->category_id),
            'categories' => CategoryResource::collection(Category::all()),
            'brands' => BrandResource::collection(Brand::all()),
            'stores' => StoreResource::collection(Store::all()),
            'products' => ProductResource::collection(Product::all()),
            'warrantyLengths' => WarrantyLengthResource::collection(WarrantyLength::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {   
        $validatedData = $request->validated();
      
        $photoName = $bill->photo;

        if($validatedData['photo']){
            Storage::delete('public/bills/'.$photoName);
            $photoName = $validatedData['photo']->store('public/bills');
            $photoName = basename($photoName);
        }

        $bill->update([
            'product_id' => $validatedData['product_id'],
            'store_id' => $validatedData['store_id'],
            'purchased_at' => Carbon::parse($validatedData['purchased_at'])->format('Y-m-d'),
            'photo' => $photoName,
            'warranty_length_id' => $validatedData['warranty_length_id'],
            'price' => $validatedData['price'],
            'note' => $validatedData['note'],
        ]);

        return redirect(route('racuni'))->with('message', [
            'body' => 'Račun izmenjen',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        Storage::delete('public/bills/'.$bill->photo);
        
        $bill->delete();

        return redirect(route('racuni'))->with('message', [
            'body' => 'Račun izbrisan',
            'type' => 'success'
        ]);
    }
}
