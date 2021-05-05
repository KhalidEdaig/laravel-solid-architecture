<?php

namespace App\Http\Company\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateCompanyValidation extends FormRequest
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
            'name' => 'required|max:70',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:companies',
            'address'=>'required',
            'webSite' => 'url|unique:companies'
            //'file' => 'required|mimes:jpeg,bmp,png|size:10000'
        ];
    }
}
