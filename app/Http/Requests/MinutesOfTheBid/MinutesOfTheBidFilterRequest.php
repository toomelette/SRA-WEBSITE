<?php

namespace App\Http\Requests\MinutesOfTheBid;

use Illuminate\Foundation\Http\FormRequest;

class MinutesOfTheBidFilterRequest extends FormRequest{

    


    public function authorize(){

        return true;
    
    }



    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
        ];

    
    } 



}
