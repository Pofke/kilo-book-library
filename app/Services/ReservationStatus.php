<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ReservationStatus
{
    public function generateWrongReservationStatusMessage($status): JsonResponse
    {
        return response()->json([
            'message' => 'Book already ' . ($status == 'E' ? 'extended' : 'returned')
        ], 422);
    }
}
