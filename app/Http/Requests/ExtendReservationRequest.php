<?php

namespace App\Http\Requests;

use App\Services\Authentication;
use Illuminate\Foundation\Http\FormRequest;

class ExtendReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
/*
        $user = $this->user();

        //return ($this->userId);
        return (new Authentication())->canUserUpdateReservation($user, $this->userId);
*/
    }

    public function rules(): array
    {
        return [
            'extendedDate' => ['sometimes', 'required'],
           // 'userId' => ['required'],
        ];
    }



    protected function prepareForValidation()
    {
        $this->merge([
            'extended_date' => $this->extendedDate,
          //  'user_id' => $this->userId,
        ]);
    }
}
