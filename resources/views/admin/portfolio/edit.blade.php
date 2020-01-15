@extends('layouts.primary')
@section('content')
    <form method="post" action="{{route('admin.portfolio.update',['portfolio'=>$portfolio->id])}}" class="form"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('admin.portfolio.form')

        @if(count($portfolio->getMedia('gallery')))
            @foreach($portfolio->getMedia('gallery') as $image)
                <div class="row mb-2">
                    <div class="col-sm-2 d-flex justify-content-end align-items-center">
                        <input type="checkbox" name="delete_images[]" value="{{$image->id}}"/>
                    </div>
                    <div class="col-sm-10">
                        <img src="{{$image->getUrl()}}"/>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="form-group row">
            <button type="submit" class="btn btn-primary offset-sm-2">@lang('Update')</button>
            <button form="deleteForm" type="submit" class="btn btn-danger ml-2">@lang('Delete')</button>
        </div>
    </form>
    <form id="deleteForm" method="post" action="{{route('admin.portfolio.destroy',['portfolio'=>$portfolio->id])}}">
        @method('DELETE')
        @csrf
    </form>
    <div>

        <div><h2>Translations</h2></div>
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
                              action="{{route('admin.portfolio.update-lang',['portfolio'=> $portfolio->id])}}"
                              method="post">
                            @method('PUT')
                            @csrf
                            @component('admin.portfolio.content_form',['portfolio'=>$portfolio,'locale'=>$lang,'component'=>true])
                            @endcomponent
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary offset-sm-2">@lang('Update')</button>
                                <button form="delete-{{$lang}}" type="submit"
                                        class="btn btn-danger ml-2">@lang('Delete')</button>
                            </div>
                        </form>

                        <form id="delete-{{$lang}}" method="post"
                              action="{{route('admin.portfolio.destroy-lang',['portfolio'=>$portfolio->id])}}">
                            @method('DELETE')
                            <input class="form-control col-sm-10" id="language" name="language" type="hidden"
                                   value="{{$lang}}"/>
                            @csrf
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
