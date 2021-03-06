<?php

namespace App\Http\Requests\NoticeToProceed;

use Illuminate\Foundation\Http\FormRequest;

class GuestNTPFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|max:90|string',
            'page' => 'nullable|max:50|numeric',
            'sort' => 'nullable|max:45|string',
            'direction' => 'nullable|max:5|string',
            
        ];

    }


    
}
