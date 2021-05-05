<?php

namespace App\Http\Employee\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateEmployeeValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => 'required|string|max:30',
            'firstname' => 'required|string|max:30',
            'password' => 'required|string|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:employees',
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }
}
