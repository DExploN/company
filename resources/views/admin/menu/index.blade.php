@extends('layouts.primary')
@section('content')
    <table class="table table-bordered bg-white">
        <thead>
        <tr class="font-weight-bold">
            <td>@lang('Sort')</td>
            <td>@lang('Path')</td>
            <td>@lang('Active path')</td>
            <td>@lang('title')</td>
            <td>@lang('FA code')</td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <form method="post" action="{{route('admin.menu.update',['menu'=>$menu->id])}}" class="form">
                @method('PUT')
                @csrf
                <tr>
                    <td><input class="form-control" type="text" name="sort" value="{{$menu->sort}}"/></td>
                    <td><input class="form-control" type="text" name="path" value="{{$menu->path}}"/></td>
                    <td><input class="form-control" type="text" name="active_path" value="{{$menu->active_path}}"/></td>
                    <td><input class="form-control" type="text" name="title" value="{{$menu->title}}"/></td>
                    <td><input class="form-control" type="text" name="fa_code" value="{{$menu->fa_code}}"/></td>
                    <td>
                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
                    </td>
                    <td>
                        <button type="submit" form="deleteMenu-{{$menu->path}}"
                                class="btn btn-danger">@lang('Delete')</button>
                    </td>
                </tr>
            </form>
            <form method="post" id="deleteMenu-{{$menu->path}}"
                  action="{{route('admin.menu.destroy',['menu'=>$menu->id])}}" class="form">
                @method('DELETE')
                @csrf
            </form>
        @endforeach
        <form method="post" action="{{route('admin.menu.store')}}" class="form">
            @csrf
            <tr>
                <td><input class="form-control" type="text" name="sort"/></td>
                <td><input class="form-control" type="text" name="path"/></td>
                <td><input class="form-control" type="text" name="active_path"/></td>
                <td><input class="form-control" type="text" name="title"/></td>
                <td><input class="form-control" type="text" name="fa_code"/></td>
                <td>
                    <button type="submit" class="btn btn-success">@lang('Add')</button>
                </td>
                <td></td>
            </tr>
        </form>
        </tbody>
    </table>
    <div class="text-muted">
        /portfolio - @lang('Portfolio')
    </div>
@endsection
