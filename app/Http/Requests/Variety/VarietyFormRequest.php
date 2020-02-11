<?php

namespace App\Http\Requests\Variety;

use Illuminate\Foundation\Http\FormRequest;

class VarietyFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rows = $this->request->get('row');

        $rules = [
            
            'doc_file' => 'nullable|mimes:jpg,jpeg,png|max:50000',
            'name'=>'required|string|max:90',

        ];


        if(!empty($rows)){

            foreach($rows as $key => $value){
                
                $rules['row.'.$key.'.seq_no'] = 'required|int|max:50';
                $rules['row.'.$key.'.field'] = 'required|string|max:90';
                $rules['row.'.$key.'.value'] = 'required|string|max:255';

            } 

        }

        return $rules;

    }




}
