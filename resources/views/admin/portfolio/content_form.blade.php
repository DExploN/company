<div class="form-group row">
    <label for="language_{{$locale}}" class="col-form-label col-sm-2">@lang('Language')</label>
    <input class="form-control col-sm-10" id="language_{{$locale}}" @if(isset($component))name="language"
           @endif readonly
           value="{{$locale}}"/>
</div>
<div class="form-group row">
    <label for="title_{{$locale}}" class="col-form-label col-sm-2">@lang('Title')</label>
    <input class="form-control col-sm-10" id="title_{{$locale}}" name="title"
           value="{{((old('language')===$locale) || (empty($component) && !old('language') && old('title')) ) ? old('title'): $portfolio->trans('title', $locale)}}"
    />
</div>
<div class="form-group row">
    <label for="description_{{$locale}}" class="col-form-label col-sm-2">@lang('Description')</label>
    <textarea class="form-control col-sm-10" id="description_{{$locale}}"
              name="description">{{((old('language')===$locale) || (empty($component) && !old('language') && old('description')) ) ? old('description'): $portfolio->trans('description', $locale)}}</textarea>
</div>
<div class="form-group row">
    <label for="text_{{$locale}}" class="col-form-label col-sm-2">@lang('Text')</label>
    <textarea class="form-control col-sm-10" id="text_{{$locale}}"
              name="text">{{((old('language')===$locale) || (empty($component) && !old('language') && old('text')) ) ? old('text'): $portfolio->trans('text', $locale)}}</textarea>
</div>
