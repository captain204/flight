<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
                'departure_city'=>'bail|required|max:3',
                'destination_city'=>'required|max:3',
                'departure_date' => 'required', 
                'return_date' =>'required|',
                'cabin'=>'required',
                'adult' =>'required',
                'children'=>'required',
                'infants'=>'required'
        ];

    }
}
