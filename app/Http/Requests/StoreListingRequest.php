<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'max:5000',
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'required',
                'exists:subcategories,id',
            ],

            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'state_id' => [
                'required',
                'exists:states,id',
            ],

            'city_id' => [
                'required',
                'exists:cities,id',
            ],

            'area_id' => [
                'required',
                'exists:areas,id',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
