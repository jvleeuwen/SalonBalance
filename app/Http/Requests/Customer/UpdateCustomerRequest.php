<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name'             => ['sometimes', 'string', 'max:255'],
            'telephone_number' => ['sometimes', 'string', 'max:50'],
            'street_address'   => ['sometimes', 'string', 'max:255'],
        ];
    }
}