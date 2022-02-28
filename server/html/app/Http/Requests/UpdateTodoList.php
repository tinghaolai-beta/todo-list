<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTodoList extends FormRequest
{
    public function rules()
    {
        return [
            'id'      => 'required|int|exists:users',
            'title'   => 'required|string',
            'content' => 'required|string',
        ];
    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'fail',
            'message' => 'invalidParams',
        ]));
    }
}
