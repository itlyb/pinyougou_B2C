<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRegister extends FormRequest
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
            'name'=>[
                'required',
                'max:18',
                'min:3',
                
            ], 
            'password'=>[
                'max:18',
                'min:6',
            ],
            'phone'=>[
                'required',
                'regex:/^13[123569][1]\d{8}|15[1235689]\d{8}|188\d{8}$/',
                
            ],
            
        ];
    }
}
