<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\V1\ReservationCollection;
use App\Models\Reservation;
use App\Services\Repositories\ReservationRepository;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(private ReservationRepository $reservationRepository)
    {
    }

    public function index(Request $request): ReservationCollection
    {
        return $this->reservationRepository->getReservations($request);
    }

    public function store(StoreReservationRequest $request)
    {
        $this->authorize('storeReservation', [Reservation::class, $request]);
        return $this->reservationRepository->createReservation($request);
    }



    public function extendBook(Reservation $reservation)
    {
        $this->authorize('viewChangeSelf', [Reservation::class, $reservation]);
        $this->authorize('updateExtendReservation', [Reservation::class, $reservation]);
        $this->reservationRepository->extendBookReservation(/*$request, */$reservation);
    }

    public function returnBook(Reservation $reservation)
    {
        $this->authorize('viewChangeSelf', [Reservation::class, $reservation]);
        $this->authorize('updateReturnReservation', [Reservation::class, $reservation]);
        $this->reservationRepository->returnReservedBook(/*$request, */$reservation);
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('viewChangeSelf', [Reservation::class, $reservation]);
        return $this->reservationRepository->getReservation($reservation);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $this->reservationRepository->updateReservation($request, $reservation);
    }

    public function destroy(Reservation $reservation)
    {
        //
    }
}
