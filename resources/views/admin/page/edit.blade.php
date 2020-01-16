@extends('layouts.primary')
@section('content')
    <form method="post" action="{{route('admin.page.update',['page'=>$page->path])}}" class="form"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('admin.page.form')

        <div class="form-group row">
            <button type="submit" class="btn btn-primary offset-sm-2">@lang('Update')</button>
            <button form="deleteForm" type="submit" class="btn btn-danger ml-2">@lang('Delete')</button>
        </div>
    </form>
    <form id="deleteForm" method="post" action="{{route('admin.page.destroy',['page'=>$page->path])}}">
        @method('DELETE')
        @csrf
    </form>
    <div>

        <div><h2>@lang('Translations')</h2></div>
        @foreach($languages as $lang)
            @if($lang != $locale)
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="collapse"
                            data-target="#{{$lang}}-box" aria-haspopup="true" aria-expanded="false">
                        {{$lang}}
                    </button>
                </div>
            @endif
        @endforeach
        <div id="lang-box">
            @foreach($languages as $lang)
                @if($lang != $locale)
                    <div id="{{$lang}}-box" class="collapse" data-parent="#lang-box">
                        <form class="form"
                              action="{{route('admin.page.update-lang',['page'=> $page->path])}}"
                              method="post">
                            @method('PUT')
                            @csrf
                            @component('admin.page.content_form',['page'=>$page,'locale'=>$lang,'component'=>true])
                            @endcomponent
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary offset-sm-2">@lang('Update')</button>
                                <button form="delete-{{$lang}}" type="submit"
                                        class="btn btn-danger ml-2">@lang('Delete')</button>
                            </div>
                        </form>

                        <form id="delete-{{$lang}}" method="post"
                              action="{{route('admin.page.destroy-lang',['page'=>$page->path])}}">
                            @method('DELETE')
                            <input class="form-control col-sm-10" name="language" type="hidden"
                                   value="{{$lang}}"/>
                            @csrf
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
