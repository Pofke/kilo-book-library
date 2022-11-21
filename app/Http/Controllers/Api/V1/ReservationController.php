<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ReservationsFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExtendReservationRequest;
use App\Http\Requests\ReturnReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\V1\ReservationCollection;
use App\Http\Resources\V1\ReservationResource;
use App\Models\Reservation;
use App\Services\Authentication;
use App\Services\Commands\GetStockQuantity;
use App\Services\ReservationStatus;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private Authentication $auth;
    private ReservationStatus $reservationStatus;
    public function __construct()
    {
        $this->auth = new Authentication();
        $this->reservationStatus = new ReservationStatus();
    }

    public function index(Request $request): ReservationCollection
    {
        $filter = new ReservationsFilter();
        $filterItems = $filter->transform($request);
        $filterItems[] = $this->auth->addExtraFilterToReader();
        $reservations = Reservation::where($filterItems);
        return new ReservationCollection($reservations->paginate()->appends($request->query()));
    }

    public function store(StoreReservationRequest $request)
    {
        $bookStock = (new GetStockQuantity())->execute($request->bookId);
        if ($bookStock <= 0) {
            return response()->json([
                'message' => 'Book is not in stock.'
            ], 422);
        }
        return new ReservationResource(Reservation::create($request->all()));
    }

    public function extendBook(ExtendReservationRequest $request, Reservation $reservation)
    {
        if ($this->auth->isUserUnauthorized($reservation)) {
            return $this->auth->generateUnauthorisedMessage();
        }
        if ($reservation->status != 'T') {
            return $this->reservationStatus->generateWrongReservationStatusMessage($reservation->status);
        }
        $reservation->status = "E";
        $reservation->update($request->all());
    }

    public function returnBook(ReturnReservationRequest $request, Reservation $reservation)
    {
        if ($this->auth->isUserUnauthorized($reservation)) {
            return $this->auth->generateUnauthorisedMessage();
        }
        if ($reservation->status == 'R') {
            return $this->reservationStatus->generateWrongReservationStatusMessage($reservation->status);
        }
        $reservation->status = "R";
        $reservation->update($request->all());
    }



    public function show(Reservation $reservation)
    {
        if ($this->auth->isUserUnauthorized($reservation)) {
            return $this->auth->generateUnauthorisedMessage();
        }
        return new ReservationResource($reservation);
    }


    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        /*
        if ($this->isUserUnauthorised($reservation)) {
            return $this->generateUnauthorisedMessage();
        }*/
        //$reservation->update($request->all());
    }

    public function destroy(Reservation $reservation)
    {
        //
    }
}
