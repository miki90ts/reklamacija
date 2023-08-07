<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;

class BillExportPdfController extends Controller
{
    public function __invoke(Request $request)
    {
        $bills = Bill::whereBelongsTo(auth()->user())
            ->with(['store', 'product.brand.category','warrantyLength'])
            ->oldest()
            ->get()
            ->toArray();

        $data = [
            'bills' => $bills
        ];

        $pdf = Pdf::loadView('pdf.bill', $data);
       
        return $pdf->stream();

        //return $pdf->download('invoice.pdf');
    }
}
