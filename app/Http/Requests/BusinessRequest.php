<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
{
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
        return [
            'name' => [
                'required',
                'string',
                $this->ignoreUniqueOnUpdate()
            ],

            'description' => ['required', 'string'],

            'website' => ['url'],

            'email' => [
                'required',
                'email',
                $this->ignoreUniqueOnUpdate()
            ],

            'phone_1' => [
                'required',
                'string',
                $this->ignoreUniqueOnUpdate()
            ],

            'phone_2' => [
                'string',
                $this->ignoreUniqueOnUpdate()
            ],

            'address' => ['required', 'string'],

            'active' => ['boolean'],

            'categories' => ['required', 'array'],

            'categories.*.id' => ['required', 'integer', 'exists:categories,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'website.url' => 'Invalid website url format.',
            'categories.required' => 'Business categories are required.',
            'categories.*.id.exists' => 'The selected category is not available.'       
        ];
    }

    protected function ignoreUniqueOnUpdate()
    {
        return $this->method() === 'PUT'
            ? Rule::unique('businesses')->ignore($this->business->id)
            : Rule::unique('businesses');
    }
}
