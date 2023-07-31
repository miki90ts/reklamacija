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
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'brands.category_id', '=', 'categories.id')
                ->groupBy('categories.id', 'categories.title', 'categories.icon')
                ->select(
                    'categories.title as category',
                    'categories.id',
                    'categories.icon',
                    DB::raw('SUM(bills.price) as total_price'),
                    DB::raw('CONCAT(ROUND(SUM(bills.price) / (SELECT SUM(bills.price) FROM bills) * 100, 2), "%") as percentage')
                )
                ->get(),
        ]);
    }
}
