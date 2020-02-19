<?php

namespace App\Http\Requests\NoticeOfAward;

use Illuminate\Foundation\Http\FormRequest;

class NoticeOfAwardFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }


    
}
