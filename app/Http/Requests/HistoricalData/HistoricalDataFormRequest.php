<?php

namespace App\Http\Requests\HistoricalData;

use Illuminate\Foundation\Http\FormRequest;

class HistoricalDataFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|max:255|string',
            'date_from' => 'nullable|date_format:"m/d/Y"',
            'date_to' => 'nullable|date_format:"m/d/Y"',
            
        ];
    
    }




}
