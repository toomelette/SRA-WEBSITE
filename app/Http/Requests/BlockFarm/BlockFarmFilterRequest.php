<?php

namespace App\Http\Requests\BlockFarm;

use Illuminate\Foundation\Http\FormRequest;

class BlockFarmFilterRequest extends FormRequest{

    
    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }




}
