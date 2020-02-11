<?php

namespace App\Http\Requests\Research;

use Illuminate\Foundation\Http\FormRequest;

class ResearchFilterRequest extends FormRequest{




    public function authorize(){
        
        return true;
    
    }



    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            
        ];
    
    }
    




}
