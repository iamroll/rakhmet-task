<?php

namespace App\Http\Requests;

use App\Model\Category;
use App\Traits\CustomErrorMessage;
use Illuminate\Foundation\Http\FormRequest;

class CategoryCheckRequest extends FormRequest
{

    use CustomErrorMessage;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id' => [
                'required',
                'exists:categories,id',
                function($attribute, $value, $fail) {
                    $isCategoryExists = Category::where('id', $value)
                        ->where('deleted_at', null)
                        ->exists();
                    if (!$isCategoryExists) {
                        return $fail("The selected ${attribute} is invalid.");
                    }
                }
            ]
        ];

        return $rules;
    }
}
