<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
