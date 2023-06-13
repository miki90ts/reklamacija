<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'store_id',
        'warranty_length_id',
        'purchased_at',
        'photo',
        'price',
        'note'
    ];

    protected $dates = ['purchased_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function warrantyLength(): BelongsTo
    {
        return $this->belongsTo(WarrantyLength::class);
    }
}
