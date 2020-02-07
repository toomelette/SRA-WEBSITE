<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }


}
