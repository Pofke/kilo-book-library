<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    public function isUserUnauthorized($reservation): bool
    {
        $user = Auth::user();
        return ($user->tokenCan('getSelf') && $user->id != $reservation->user_id);
    }

    public function addExtraFilterToReader()
    {
        $user = Auth::user();
        if ($user->tokenCan('getSelf')) {
            return ["user_id", '=', $user->id];
        }
    }

    public function generateUnauthorisedMessage(): JsonResponse
    {
        return response()->json([
            'message' => 'This action is unauthorized.'
        ], 403);
    }
/*
    public function canUserCreateReservation($user, $userId): bool
    {
        return $user != null && (($user->tokenCan('createSelf') && $userId == $user->id) || $user->tokenCan('create'));
    }

    public function canUserUpdateReservation($user, $userId): bool
    {
        return $user != null && (($user->tokenCan('updateSelf') && $userId == $user->id) || $user->tokenCan('update'));
    }*/
}
