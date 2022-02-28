<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTodoList extends FormRequest
{
    public function rules()
    {
        return [
            'title'       => 'required|string',
            'todoContent' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'fail',
            'message' => 'invalidParams',
        ]));
    }
}
