<?php

namespace App\Traits;

use   Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait CustomErrorMessage
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'error' => $validator->errors(),
        ], 422));
    }
}
