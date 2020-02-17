<?php

namespace App\Http\Requests\SidaProgramCategory;

use Illuminate\Foundation\Http\FormRequest;

class SidaProgramCategoryFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'name' => 'required|max:255|string',
            
        ];
    
    }



}
