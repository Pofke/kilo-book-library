<?php

namespace App\Http\Requests;

use App\Services\Authentication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    public function rules(): array
    {
        return [
            'bookId' => ['required', 'integer'],
            'userId' => ['required', 'integer'],
            'status' => ['sometimes', 'required', Rule::in(['T', 'E', 'R'])],
            'extendedDate' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
            'returnedDate' => ['sometimes', 'required', 'date_format:Y-m-d H:i:s'],
        ];
    }


    protected function prepareForValidation()
    {

        $data = [];
        $data['book_id'] = $this->bookId;
        $data['user_id'] = $this->userId;
        if ($this->extendedDate) {
            $data['extended_date'] = $this->extendedDate;
        }
        if ($this->returnedDate) {
            $data['returned_date'] = $this->returnedDate;
        }
        $this->merge($data);
    }
}
