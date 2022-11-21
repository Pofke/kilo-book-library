<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'bookId' => $this->book_id,
            'userId' => $this->user_id,
            'status' => $this->status,
            'takenDate' => $this->created_at,
            'extendedDate' => $this->extended_date,
            'returnedDate' => $this->returned_date

        ];
    }
}
