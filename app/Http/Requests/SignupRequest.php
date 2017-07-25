<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Frontend\Fields;

class SignupRequest extends FormRequest
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
    public function rules( Fields $fields)
    {
        $signupFielsd           =   $fields->signup();
        $rules                  =   [];
        foreach( $signupFielsd as $key => $field ) {
            $rules[ $key ]      =   $field[ 'rule' ];
        }
        return $rules;
    }
}
