<div class="form-group row">
    <label for="language" class="col-form-label col-sm-2">@lang('Language')</label>
    <input class="form-control col-sm-10" id="language" name="language" readonly value="{{$locale}}"/>
</div>
<div class="form-group row">
    <label for="title" class="col-form-label col-sm-2">@lang('Title')</label>
    <input class="form-control col-sm-10" id="title" name="title" value="{{$portfolio->trans('title', $locale)}}"/>
</div>
<div class="form-group row">
    <label for="description" class="col-form-label col-sm-2">@lang('Description')</label>
    <textarea class="form-control col-sm-10" id="description"
              name="description">{{$portfolio->trans('description', $locale)}}</textarea>
</div>
<div class="form-group row">
    <label for="text" class="col-form-label col-sm-2">@lang('Text')</label>
    <textarea class="form-control col-sm-10" id="text" name="text">{{$portfolio->trans('text', $locale)}}</textarea>
</div>
