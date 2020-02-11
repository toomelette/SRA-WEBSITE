<?php

namespace App\Http\Requests\Research;

use Illuminate\Foundation\Http\FormRequest;

class ResearchFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'title' => 'required|max:90|string',
            'content' => 'required',
            
        ];
    
    }





}
