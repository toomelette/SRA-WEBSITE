<?php

namespace App\Http\Requests\Bioenergy;

use Illuminate\Foundation\Http\FormRequest;

class BioenergyFilterRequest extends FormRequest{

    
    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }
    


}
