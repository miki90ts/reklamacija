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
            'purchased_at' => Carbon::parse($this->purchased_at)->toDateString(),
            'expired_at' => Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months)->toDateString(),
            'expired_at_for_humans' => Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months)->diffForHumans(null, ['syntax' => Carbon::DIFF_ABSOLUTE]),
            'color' => $this->getColorBasedOnExpiration(),
            'percent' => $this->getProcentBasedOnExpiration(),
            'photo' => asset('storage/bills/'.$this->photo),
            'price' => $this->price,
            'store' => StoreResource::make($this->whenLoaded('store')),
            'product' => ProductResource::make($this->whenLoaded('product')),
        ];
    }

    private function getColorBasedOnExpiration()
    {
        $expiredAt = Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months);
        $diffInMonths = Carbon::now()->diffInMonths($expiredAt);

        if ($diffInMonths > 12) {
            return 'blue';
        } elseif ($diffInMonths >= 6 && $diffInMonths <= 12) {
            return 'green';
        } elseif ($diffInMonths >= 3 && $diffInMonths < 6) {
            return 'orange';
        } else {
            return 'red';
        }
    }

    private function getProcentBasedOnExpiration()
    {
        $expiredAt = Carbon::parse($this->purchased_at)->addMonths($this->warrantyLength->months);
        $diffInMonths = Carbon::now()->diffInMonths($expiredAt);

        if ($diffInMonths > 24) {
            return '100';
        } elseif ($diffInMonths >= 18 && $diffInMonths <= 24) {
            return '80';
        } elseif ($diffInMonths >= 12 && $diffInMonths <= 18) {
            return '65';
        } elseif ($diffInMonths >= 9 && $diffInMonths < 12) {
            return '50';
        }elseif ($diffInMonths >= 6 && $diffInMonths < 9) {
            return '30';
        }elseif ($diffInMonths >= 3 && $diffInMonths < 6) {
            return '15';
        } else {
            return '5';
        }
    }
}
