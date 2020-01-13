<div class="form-group row">
    <label for="language" class="col-form-label col-sm-2">@lang('Language')</label>
    <input class="form-control col-sm-10" id="language" @if(isset($component))name="language" @endif readonly
           value="{{$locale}}"/>
</div>
<div class="form-group row">
    <label for="title" class="col-form-label col-sm-2">@lang('Title')</label>
    <input class="form-control col-sm-10" id="title" name="title"
           value="{{((old('language')===$locale) || (empty($component) && !old('language') && old('title')) ) ? old('title'): $portfolio->trans('title', $locale)}}"
    />
</div>
<div class="form-group row">
    <label for="description" class="col-form-label col-sm-2">@lang('Description')</label>
    <textarea class="form-control col-sm-10" id="description"
              name="description">{{((old('language')===$locale) || (empty($component) && !old('language') && old('description')) ) ? old('description'): $portfolio->trans('description', $locale)}}</textarea>
</div>
<div class="form-group row">
    <label for="text" class="col-form-label col-sm-2">@lang('Text')</label>
    <textarea class="form-control col-sm-10" id="text"
              name="text">{{((old('language')===$locale) || (empty($component) && !old('language') && old('text')) ) ? old('text'): $portfolio->trans('text', $locale)}}</textarea>
</div>
