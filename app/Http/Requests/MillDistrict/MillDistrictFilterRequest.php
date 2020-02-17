<?php

namespace App\Http\Requests\MillDistrict;

use Illuminate\Foundation\Http\FormRequest;

class MillDistrictFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }


    
}
