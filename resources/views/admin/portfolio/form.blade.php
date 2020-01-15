@include('admin.portfolio.content_form')
<div class="form-group row">
    <label for="image" class="col-form-label col-sm-2">@lang('Image')</label>
    <input type="file" class="form-control-file col-sm-10" id="image" name="image"/>

</div>
@if($logo = $portfolio->getMedia('logo')->first())

    <div class="form-group  row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <img class="img-fluid" src="{{$logo->getUrl()}}"/>
        </div>
    </div>
@endif

<div class="form-group row">
    <label for="year" class="col-form-label col-sm-2">@lang('Year')</label>
    <input class="form-control col-sm-10" id="year" name="year" value="{{old('year',$portfolio->year)}}"/>
</div>

<div class="form-group row">
    <label for="android_link" class="col-form-label col-sm-2">@lang('Android link')</label>
    <input class="form-control col-sm-10" id="android_link" name="android_link"
           value="{{old('android_link',$portfolio->android_link)}}"/>
</div>

<div class="form-group row">
    <label for="apple_link" class="col-form-label col-sm-2">@lang('Apple link')</label>
    <input class="form-control col-sm-10" id="apple_link" name="apple_link"
           value="{{old('apple_link',$portfolio->apple_link)}}"/>
</div>

<div class="form-group row">
    <label for="gallery" class="col-form-label col-sm-2">@lang('Gallery')</label>
    <div class="col-sm-10 images">
        <a class="btn-info btn text-white mb-3 add-image">@lang('Add image')</a>
        <input class="form-control-file mb-1" type="file" id="gallery" name="images[]"/>
    </div>

</div>
