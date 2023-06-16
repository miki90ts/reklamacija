<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatisticIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return inertia()->render('Statistic/Index', [
            'priceByCategory' => Bill::join('products', 'bills.product_id', '=', 'products.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->groupBy('categories.id', 'categories.title')
                        ->select(
                            'categories.title as category',
                            'categories.id',
                            DB::raw('SUM(bills.price) as total_price'),
                            DB::raw('CONCAT(ROUND(SUM(bills.price) / (SELECT SUM(bills.price) FROM bills) * 100, 2), "%") as percentage')
                        )
                        ->get(),
        ]);
    }
}
