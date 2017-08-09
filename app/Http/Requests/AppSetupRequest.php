<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Fields;

class AppSetupRequest extends FormRequest
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
        $setupFields        =   $fields->setup( 2 ); // for For App Setup
        $rules              =   [];
        foreach( $setupFields as $key => $field ) {
            if( @$field[ 'rule' ] ) {
                $rules[ $key ]  =   $field[ 'rule' ];
            }
        }
        return $rules;
    }
}
