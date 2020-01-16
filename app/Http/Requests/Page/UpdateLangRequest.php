<?php

namespace App\Http\Requests\Page;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UpdateLangRequest extends StoreRequest
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
        $rules = Arr::only(parent::rules(), ['title', 'text', 'description', 'keywords', 'h1']);
        $rules['language'] = Rule::in(array_keys(LaravelLocalization::getSupportedLocales()));
        return $rules;
    }
}
