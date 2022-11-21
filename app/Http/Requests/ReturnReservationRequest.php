<?php

namespace App\Http\Requests;

use App\Services\Authentication;
use Illuminate\Foundation\Http\FormRequest;

class ReturnReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'returnedDate' => ['sometimes', 'required'],
           // 'userId' => ['required'],
        ];
    }



    protected function prepareForValidation()
    {
        $this->merge([
            'returned_date' => $this->returnedDate,
        ]);
    }
}
