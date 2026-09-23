<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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

    public function messages(): array
    {
        return [
            'type.required' => 'Please select listing type.',
            'name.required' => 'Please enter listing name.',
            'detail.required' => 'Please enter listing details.',
            'category_id.required' => 'Please select a category.',
            'subcategory_id.required' => 'Please select a subcategory.',
            'country_id.required' => 'Please select a country.',
            'state_id.required' => 'Please select a state.',
            'city_id.required' => 'Please select a city.',
            'area_id.required' => 'Please select an area.',
            'price.required' => 'Please enter price.',
        ];
    }
}
