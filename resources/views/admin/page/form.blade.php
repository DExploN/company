@push('scripts')
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
@endpush
@include('admin.page.content_form')
<div class="form-group row">
    <label for="path" class="col-form-label col-sm-2">@lang('Path')</label>
    <input type="text" class="form-control col-sm-10" id="path" name="path" value="{{old('path',$page->path)}}"/>
</div>

