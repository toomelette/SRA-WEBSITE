<?php

namespace App\Http\Requests\SIDAGuideline;

use Illuminate\Foundation\Http\FormRequest;

class SIDAGuidelineFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }


    
}
