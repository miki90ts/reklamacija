<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'address',
        'phone',
        'email',
    ];

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }
}
