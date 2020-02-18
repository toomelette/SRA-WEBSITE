<?php

namespace App\Http\Requests\InvitationToBid;

use Illuminate\Foundation\Http\FormRequest;

class InvitationToBidFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }


    
}
