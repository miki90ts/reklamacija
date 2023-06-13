<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\{Store,WarrantyLength, Product, Category, Bill};
use App\Policies\{StorePolicy,WarrantyLengthPolicy, ProductPolicy, CategoryPolicy, BillPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Store::class => StorePolicy::class,
        WarrantyLength::class => WarrantyLengthPolicy::class,
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Bill::class => BillPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
