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
            'title' => ['required', 'min:5'],
            'year' => ['required', 'numeric', 'max:2100'],
            'description' => ['required', 'min:10'],
            'text' => ['required', 'min:10'],
            'image' => ['required', 'max:2048', 'image', 'dimensions:ratio=5/3'],
            'android_link' => ['url'],
            'apple_link' => ['url'],
            'images.*' => ['max:4096', 'image'],
        ];
    }
}
