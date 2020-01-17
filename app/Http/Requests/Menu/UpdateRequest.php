<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use function GuzzleHttp\Psr7\parse_request;

class UpdateRequest extends StoreRequest
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
        $rules = parent::rules();
        $rules['path'] = ['required', 'max:30', 'regex:/^[a-z\-0-9_]+$/i', 'unique:menus,path,' . $this->menu->id];
        $rules['active_path'] = ['required', 'max:30', 'regex:/^[a-z\-0-9_]+$/i', 'unique:menus,active_path,' . $this->menu->id];
        return $rules;
    }
}
