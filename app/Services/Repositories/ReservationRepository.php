<?php

namespace App\Services\Repositories;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\V1\ReservationCollection;
use App\Http\Resources\V1\ReservationResource;
use App\Models\Reservation;
use App\Services\Commands\Reservations\GetFilteredReservations;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationRepository
{
    public function getReservations(Request $request): ReservationCollection
    {
        $reservations = (new GetFilteredReservations())->execute($request);
        return new ReservationCollection($reservations->paginate()->appends($request->query()));
    }

    public function createReservation(StoreReservationRequest $request): ReservationResource
    {
       // print_r($request);
        return new ReservationResource(Reservation::create($request->all()));
    }



    public function extendBookReservation(Reservation $reservation): void
    {
        $request = [];
        $request['status'] = "E";
        $request['extended_date'] = Carbon::now()->addMonth();

        $reservation->update($request);
    }

    public function returnReservedBook(Reservation $reservation): void
    {
        $request = [];
        $request['status'] = "R";
        $request['returned_date'] = Carbon::now();
        $reservation->update($request);
    }

    public function getReservation(Reservation $reservation): ReservationResource
    {
        return new ReservationResource($reservation);
    }

    public function updateReservation(UpdateReservationRequest $request, Reservation $reservation): void
    {
        $reservation->update($request->all());
    }
}
