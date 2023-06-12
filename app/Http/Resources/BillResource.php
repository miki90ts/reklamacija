<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'purchased_at' => Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months)->toDateString(),
            'photo' => asset('storage/bills/'.$this->photo),
            'price' => $this->price,
            'store' => StoreResource::make($this->whenLoaded('store')),
            'product' => ProductResource::make($this->whenLoaded('product')),
        ];
    }
}
