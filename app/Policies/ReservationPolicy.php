<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use App\Services\Commands\Books\GetStockQuantity;
use App\Services\Commands\Reservations\FailReservationStatusUpdateMessage;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class ReservationPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return !($user->tokenCan('getSelf'));
    }

    public function viewChangeSelf(User $user, Reservation $reservation): bool
    {
        $admin = $user->tokenCan('get');
        $allow = $user->tokenCan('getSelf') && $user->id == $reservation->user_id;
        return $admin || $allow;
    }

    public function updateExtendReservation(User $user, Reservation $reservation): Response
    {
        return $reservation->status == 'T' ?
            Response::allow() :
            Response::denyWithStatus(
                422,
                (new FailReservationStatusUpdateMessage())->execute($reservation->status)
            );
    }

    public function storeReservation(User $user, Request $request)
    {
        $stockQuantity = (new GetStockQuantity())->execute($request->bookId);
        if ($stockQuantity > 0 || ($stockQuantity <= 0 && $request->status == 'R')) {
            return Response::allow();
        }
        return
            Response::denyWithStatus(
                422,
                'Book is not in stock.'
            );
    }

    public function updateReturnReservation(User $user, Reservation $reservation): Response
    {
        return $reservation->status != 'R' ?
            Response::allow() :
            Response::denyWithStatus(
                422,
                (new FailReservationStatusUpdateMessage())->execute($reservation->status)
            );
    }



    public function create(User $user)
    {
    }

    public function update(User $user, Reservation $reservation)
    {
        //
    }

    public function delete(User $user, Reservation $reservation)
    {
        //
    }

    public function restore(User $user, Reservation $reservation)
    {
        //
    }

    public function forceDelete(User $user, Reservation $reservation)
    {
        //
    }
}
