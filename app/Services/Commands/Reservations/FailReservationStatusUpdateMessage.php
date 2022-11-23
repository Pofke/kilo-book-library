<?php

namespace App\Services\Commands\Reservations;

class FailReservationStatusUpdateMessage
{
    public function execute($status): string
    {
        return sprintf(
            "Book already %s",
            $status == 'E' ?
                'extended' :
                'returned'
        );
    }
}
