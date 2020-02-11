<?php

namespace App\Http\Requests\TradersDirectory;

use Illuminate\Foundation\Http\FormRequest;

class TradersDirectoryFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:255|string',
            
        ];
    
    }
    




}
