<div class="form-group row">
    <label for="language_{{$locale}}" class="col-form-label col-sm-2">@lang('Language')</label>
    <input class="form-control col-sm-10" id="language_{{$locale}}" @if(isset($component))name="language"
           @endif readonly
           value="{{$locale}}"/>
</div>
<div class="form-group row">
    <label for="title_{{$locale}}" class="col-form-label col-sm-2">@lang('Title')</label>
    <input class="form-control col-sm-10" id="title_{{$locale}}" name="title"
           value="{{((old('language')===$locale) || (empty($component) && !old('language') && old('title')) ) ? old('title'): $page->trans('title', $locale)}}"
    />
</div>

<div class="form-group row">
    <label for="keywords_{{$locale}}" class="col-form-label col-sm-2">@lang('Keywords')</label>
    <input class="form-control col-sm-10" id="keywords_{{$locale}}" name="keywords"
           value="{{((old('language')===$locale) || (empty($component) && !old('language') && old('keywords')) ) ? old('keywords'): $page->trans('keywords', $locale)}}"
    />
</div>

<div class="form-group row">
    <label for="h1_{{$locale}}" class="col-form-label col-sm-2">@lang('H1')</label>
    <input class="form-control col-sm-10" id="h1_{{$locale}}" name="h1"
           value="{{((old('language')===$locale) || (empty($component) && !old('language') && old('h1')) ) ? old('h1'): $page->trans('h1', $locale)}}"
    />
</div>

<div class="form-group row">
    <label for="description_{{$locale}}" class="col-form-label col-sm-2">@lang('Description')</label>
    <textarea class="form-control col-sm-10" id="description_{{$locale}}"
              name="description">{{((old('language')===$locale) || (empty($component) && !old('language') && old('description')) ) ? old('description'): $page->trans('description', $locale)}}</textarea>
</div>
<div class="form-group row">
    <label for="text_{{$locale}}" class="col-form-label col-sm-2">@lang('Text')</label>
    <div class="col-sm-10 m-0 p-0">
    <textarea class="my-editor-{{$locale}}" id="text_{{$locale}}"
              name="text">{!!((old('language')===$locale) || (empty($component) && !old('language') && old('text')) ) ? old('text'): $page->trans('text', $locale)!!}</textarea>
    </div>
</div>


@push('scripts')
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea.my-editor-{{$locale}}",
            height: "400",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'en/filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endpush
