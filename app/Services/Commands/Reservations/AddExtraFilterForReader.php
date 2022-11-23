<?php

namespace App\Services\Commands\Reservations;

class AddExtraFilterForReader
{
    public function execute(int $userId): array
    {
        return ["user_id", '=', $userId];
    }
}
