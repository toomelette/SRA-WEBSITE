<?php

namespace App\Http\Requests\SIDALaw;

use Illuminate\Foundation\Http\FormRequest;

class SIDALawFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }


    
}
