@extends('layouts.primary')
@section('content')
    <a class="btn btn-success mb-4" href="{{route('admin.page.create')}}">@lang('Create')</a>
    <table class="table table-bordered bg-white">
        <thead>
        <tr class="font-weight-bold">
            <td>@lang('Path')</td>
            <td>@lang('Title')</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{$page->path}}</td>
                <td>{{$page->trans('title')}}</td>
                <td><a href="{{route('admin.page.edit',['page'=>$page->path])}}"
                       class="btn btn-info text-white">@lang('Update')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$pages->links()}}
@endsection
