<?php

namespace App\Http\Requests\NoticeOfAward;

use Illuminate\Foundation\Http\FormRequest;

class NoticeOfAwardFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file_noa' => 'nullable|mimes:pdf|max:50000',
            'doc_file_bacreso' => 'nullable|mimes:pdf|max:50000',
            'description' => 'required|max:255|string',
            'station' => 'required|max:5|string',
            'date' => 'required|date_format:"m/d/Y"',
            
        ];
    
    }



}
