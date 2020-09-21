<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'details' => $this->details,
            'price' => $this->price,
            'stock' => $this->stock == 0
                ? 'out of stock' : $this->stock,

            'discount' => $this->discount,

            'rating' => $this->reviews->count() > 0
                ? round($this->reviews->sum('star') /
                    $this->reviews->count(), 2) : 'no Rating',

            'totalPrice' => round((1 - ($this->discount / 100))
                * $this->price, 2),

            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]
        ];
    }
}
