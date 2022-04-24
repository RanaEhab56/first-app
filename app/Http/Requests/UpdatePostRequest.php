<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            
                'title' =>[
                    'required','min:3',
                    Rule::unique('posts')->ignore($this->post)],
                'description' => ['required', 'min:10'],
                'fileUpload'=>['nullable','image','mimes:jpg,png'],
        
        ];
    }

    public function messages(){
        return [
            'title.required' => 'The title is required you must enter a value',

        ];
    }
}