<?php

namespace App\Http\Requests\PlantersDirectory;

use Illuminate\Foundation\Http\FormRequest;

class PlantersDirectoryFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
