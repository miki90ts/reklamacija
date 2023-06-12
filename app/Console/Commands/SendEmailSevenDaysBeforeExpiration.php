<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Bill;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SevenDaysBeforeExpiration;

class SendEmailSevenDaysBeforeExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:seven-days-before-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected const DAYS_FROM_EXPIRATION = 7;
    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $bills = Bill::query()
        ->join('users', 'bills.user_id', '=', 'users.id')
        ->join('products', 'bills.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('stores', 'bills.store_id', '=', 'stores.id')
        ->join('warranty_lengths', 'bills.warranty_length_id', '=', 'warranty_lengths.id')
        ->whereRaw('DATE_ADD(bills.purchased_at, INTERVAL warranty_lengths.months MONTH) = ?', [Carbon::now()->subDays(self::DAYS_FROM_EXPIRATION)->toDateString()])
        ->get([
            'users.name',
            'users.email',
            'products.title as product_title',
            'stores.title as store_title',
            'bills.id',
            'bills.photo',
            'bills.purchased_at',
        ]);
        
        foreach($bills as $key => $bill)
        {
            Mail::to($bill->email)->send(new SevenDaysBeforeExpiration($bill));
        }
    }
}
