<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $statusText;
    public function __construct($resource, $statusText = null)
    {
        parent::__construct($resource);
        $this->statusText = $statusText;
    }
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'status' => $this->statusText,
            'count' => $this->collection->count(),
        ];
    }
}
