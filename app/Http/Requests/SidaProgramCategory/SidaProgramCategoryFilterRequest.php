<?php

namespace App\Http\Requests\SidaProgramCategory;

use Illuminate\Foundation\Http\FormRequest;

class SidaProgramCategoryFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
