<?php

namespace App\Http\Controllers\Request;

use Illuminate\Foundation\Http\FormRequest;

class StorePercentageRequest extends FormRequest{
    public function authorize():bool
    {
        return true;
    }



    public function rules(): array{
       return [
           'name'=>'required|string|max:255'

       ];
    }



    public function messages(){
        return [];
    }
}
