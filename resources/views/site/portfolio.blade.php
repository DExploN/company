@extends('layouts.primary')
@section('content')
    <div class="row">
        @foreach($portfolios as $portfolio)
            <div class="col-12 col-md-6 mb-4">
                <div class="portfolio card">
                    <img src="{{($img = $portfolio->getMedia('logo')->first())? $img->getUrl() : ''}}"
                         class="card-img-top portfolio__image">
                    <div class="card-body portfolio__short-text">
                        <div class="position-relative">
                            <span
                                class="portfolio__title portfolio__full-text-toggler">{{$portfolio->trans('title')}}</span>
                            <i class="portfolio__full-text-angle portfolio__full-text-toggler fas fa-angle-down pt-1"></i>
                        </div>
                        <p class="card-text">{{$portfolio->trans('description')}}</p>
                    </div>

                    <div class="card-body border-top portfolio__links-container d-flex">
                        <a href="{{$portfolio->android_link}}" class="portfolio__link "><i
                                class="fab fa-android-old"></i></a>
                        <a href="{{$portfolio->apple_link}}" class="portfolio__link"><i class="fab fa-apple"></i></a>

                        @foreach($portfolio->getMedia('gallery') as $image)
                            @if ($loop->first)
                                <a href="{{$image->getUrl()}}" class="portfolio__link gallery-image"><i
                                        class="far fa-images"></i></a>
                            @else
                                <a href="{{$image->getUrl()}}" class="d-none gallery-image"></a>
                            @endif
                        @endforeach


                    </div>
                    <div class="portfolio__full-text">
                        <div class="card-body">
                            <div class="position-relative">
                                <h2 class="portfolio__title portfolio__full-text-toggler">{{$portfolio->trans('title')}}</h2>
                                <i class="portfolio__full-text-times portfolio__full-text-toggler fas fa-times"></i>
                            </div>
                            {{$portfolio->trans('text')}}
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
