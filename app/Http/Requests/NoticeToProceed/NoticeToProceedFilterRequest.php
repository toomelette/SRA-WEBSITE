<?php

namespace App\Http\Requests\NoticeToProceed;

use Illuminate\Foundation\Http\FormRequest;

class NoticeToProceedFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }


    
}
