<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             // 'customer_username' => 'required',
            'customer_last_name' => 'required|min:3|max:255',
            'customer_first_name' => 'required|min:3|max:255',
            'customer_middle_name' => 'sometimes|min:3|max:255',
            'customer_address' => 'required|min:10|max:2250',
            'customer_cp_number' => 'required|digits:11',
            'customer_birthdate' => 'required'
        ];
    }
}
