<?php

namespace App\Http\Requests\Variety;

use Illuminate\Foundation\Http\FormRequest;

class VarietyFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }


    
}
