<?php

namespace App\Http\Requests\SMSForm;

use Illuminate\Foundation\Http\FormRequest;

class SMSFormFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
