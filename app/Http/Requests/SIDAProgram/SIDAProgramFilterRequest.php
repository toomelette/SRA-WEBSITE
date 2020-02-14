<?php

namespace App\Http\Requests\SIDAProgram;

use Illuminate\Foundation\Http\FormRequest;

class SIDAProgramFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }
    


}
