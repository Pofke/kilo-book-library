<?php

namespace App\Http\Requests;

use App\Services\Authentication;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return (new Authentication())->canUserCreateReservation($user, $this->userId);

       // return $user != null && ($user->tokenCan('createSelf') && $this->userId == $user->id);
    }

    public function rules(): array
    {
        return [
            'bookId' => ['required'],
            'userId' => ['required']
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'book_id' => $this->bookId,
            'user_id' => $this->userId,
        ]);
    }
}
