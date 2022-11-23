<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    public function isUserUnauthorized($reservation): bool
    {
        $user = Auth::id();
        return ($user->tokenCan('getSelf') && $user != $reservation->user_id);
    }

    public function addExtraFilterToReader($userId)
    {
        return ["user_id", '=', $userId];
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
