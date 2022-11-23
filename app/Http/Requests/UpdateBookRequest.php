<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function rules(): array
    {
        $method = $this->method();
        $sometimes = null;
        if ($method == 'PATCH') {
            $sometimes = 'sometimes';
        }
        return [
            'name' => [$sometimes, 'required'],
            'author' => [$sometimes, 'required'],
            'year' => [$sometimes, 'required', 'integer'],
            'genre' => [$sometimes, 'required'],
            'pages' => [$sometimes, 'required', 'integer'],
            'language' => [$sometimes, 'required'],
            'quantity' => [$sometimes, 'required', 'integer']
        ];
    }
}
