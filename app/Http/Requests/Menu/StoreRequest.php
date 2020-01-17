<?php

namespace App\Http\Requests\Menu;

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
            'path' => ['required', 'max:30', 'regex:/^[a-z\-0-9_]+$/i', 'unique:menus,path'],
            'active_path' => ['required', 'regex:/^[a-z\-0-9_]+$/i', 'max:30', 'unique:menus,active_path'],
            'title' => ['required'],
            'fa_code' => ['required'],
            'sort' => ['nullable', 'numeric']
        ];
    }
}
