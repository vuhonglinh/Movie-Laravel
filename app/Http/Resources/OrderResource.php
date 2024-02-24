<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CustomerResource;

class OrderResource extends JsonResource
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
            'amount' => $this->amount,
            'expiry_date' => $this->expiry_date,
            'customers' => CustomerResource::collection($this->whenLoaded(''))//Khi nó là 1 danh sách thì mới dùng
        ];
    }
}
