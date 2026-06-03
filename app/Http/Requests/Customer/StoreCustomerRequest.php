<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name'             => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'string', 'max:50'],
            'street_address'   => ['required', 'string', 'max:255'],
        ];
    }
}