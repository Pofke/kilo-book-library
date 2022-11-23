<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    public function rules(): array
    {
        $method = $this->method();
        $sometimes = null;
        if ($method == 'PATCH') {
            $sometimes = 'sometimes';
        }
        return [
            'bookId' => [$sometimes, 'required', 'integer'],
            'userId' => [$sometimes, 'required', 'integer'],
            'status' => [$sometimes, 'required', Rule::in(['T', 'E', 'R'])],
            'extendedDate' => [$sometimes, 'required', 'date_format:Y-m-d H:i:s'],
            'returnedDate' => [$sometimes, 'required', 'date_format:Y-m-d H:i:s'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];
        if ($this->bookId) {
            $data->book_id = $this->bookId;
        }
        if ($this->userId) {
            $data->user_id = $this->userId;
        }
        if ($this->extendedDate) {
            $data->extended_date = $this->extendedDate;
        }
        if ($this->returnedDate) {
            $data->returned_date = $this->returnedDate;
        }
        $this->merge($data);
    }
}
