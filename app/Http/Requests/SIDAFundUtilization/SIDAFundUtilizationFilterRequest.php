<?php

namespace App\Http\Requests\SIDAFundUtilization;

use Illuminate\Foundation\Http\FormRequest;

class SIDAFundUtilizationFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }


    
}
