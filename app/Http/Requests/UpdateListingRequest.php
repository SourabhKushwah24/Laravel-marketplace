<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                'in:product,service',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'detail' => [
                'required',
                'string',
                'min:10',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'required',
                'integer',
                'exists:subcategories,id',
            ],

            'country_id' => [
                'required',
                'integer',
                'exists:countries,id',
            ],

            'state_id' => [
                'required',
                'integer',
                'exists:states,id',
            ],

            'city_id' => [
                'required',
                'integer',
                'exists:cities,id',
            ],

            'area_id' => [
                'required',
                'integer',
                'exists:areas,id',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:9999999999.99',
            ],
        ];
    }
}
