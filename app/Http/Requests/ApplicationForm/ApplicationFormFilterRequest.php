<?php

namespace App\Http\Requests\ApplicationForm;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationFormFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
