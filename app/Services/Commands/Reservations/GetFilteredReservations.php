<?php

namespace App\Services\Commands\Reservations;

use App\Filters\V1\ReservationsFilter;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetFilteredReservations
{
    public function execute(Request $request): Builder
    {
        $filter = new ReservationsFilter();
        $filterItems = $filter->transform($request);
        $user = Auth::user();
        if ($user->cannot('viewAny', Reservation::class)) {
            $filterItems[] = (new AddExtraFilterForReader())->execute($user->id);
        }
        return Reservation::where($filterItems);
    }
}
