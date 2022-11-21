<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'author' => $this->author,
            'year' => $this->year,
            'genre' => $this->genre,
            'pages' => $this->pages,
            'language' => $this->language,
            'currentStock' => $this->quantity - $this->reservations_count,
            'quantity' => $this->quantity
        ];
    }
}
