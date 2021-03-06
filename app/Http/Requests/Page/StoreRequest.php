<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'path' => ['required', 'unique:pages,path', 'regex:/^[a-z\-0-9_]+$/i'],
            'title' => ['required'],
            'description' => ['required'],
            'keywords' => ['required'],
            'h1' => ['required'],
            'text' => ['required'],

        ];
    }
}
