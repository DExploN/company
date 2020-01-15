<?php

namespace App\Http\Requests\Portfolio;

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
            'title' => ['required'],
            'year' => ['required', 'numeric',],
            'description' => ['required'],
            'text' => ['required'],
            'image' => ['required', 'max:2048', 'image'],
            'android_link' => ['url', 'nullable'],
            'apple_link' => ['url', 'nullable'],
            'images.*' => ['max:4096', 'image'],
        ];
    }
}
