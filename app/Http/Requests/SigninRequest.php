<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Fields;

class SigninRequest extends FormRequest
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
    public function rules( Fields $fields )
    {
        $signupFields           =   $fields->signin();
        $rules                  =   [];
        foreach( $signupFields as $key => $field ) {
            if( @$field[ 'rule' ] ) {
                $rules[ $key ]      =   $field[ 'rule' ];
            }
        }
        return $rules;
    }
}
