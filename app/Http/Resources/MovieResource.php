<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'name' => $this->name,
            'views' => $this->views,
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'countries' => CountryResource::collection($this->whenLoaded('countries')),
        ];
    }
}
