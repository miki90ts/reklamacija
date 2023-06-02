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
            'purchased_at' => Carbon::parse($this->purchased_at)->addYears(2)->toDateString(),
            'photo' => $this->photo,
            'store' => StoreResource::make($this->whenLoaded('store')),
            'product' => ProductResource::make($this->whenLoaded('product')),
            // 'participants' => PublicUserResource::collection($this->whenLoaded('participants'))
        ];
    }
}
