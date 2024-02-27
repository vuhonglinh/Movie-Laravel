<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    private $statusCode;
    private $statusText;
    public function __construct($resource, $statusCode = 200, $statusText = 'success')
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->statusCode,
            'message' => $this->statusText,
            'data' => $this->collection,
            'count' => $this->count(),
        ];
    }
}
