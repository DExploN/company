@extends('layouts.primary')
@section('content')
    <a class="btn btn-success mb-4" href="{{route('admin.portfolio.create')}}">@lang('Create')</a>
    <table class="table table-bordered bg-white">
        <thead>
        <tr class="font-weight-bold">
            <td>@lang('Title')</td>
            <td>@lang('Year')</td>
            <td>@lang('Description')</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($portfolios as $portfolio)
            <tr>
                <td>{{$portfolio->trans('title')}}</td>
                <td>{{$portfolio->year}}</td>
                <td>{{$portfolio->trans('description')}}</td>
                <td><a href="{{route('admin.portfolio.edit',['portfolio'=>$portfolio->id])}}"
                       class="btn btn-info text-white">@lang('Update')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$portfolios->links()}}
@endsection
