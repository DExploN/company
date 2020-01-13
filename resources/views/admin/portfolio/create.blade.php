@extends('layouts.primary')
@section('content')
    <form method="post" action="{{route('admin.portfolio.store')}}" class="form" enctype="multipart/form-data">
        @csrf
        @include('admin.portfolio.form')
        <div class="form-group row">
            <button type="submit" class="btn btn-primary offset-sm-2">@lang('Create')</button>
        </div>
    </form>
@endsection
