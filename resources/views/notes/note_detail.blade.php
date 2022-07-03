@extends('layouts.note')


@section('breadcrumb')
    <a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
    <li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.noteDetails')</li>
@endsection

@section('column')
    @auth
        @if($reader_exist)
            <a href="{{ route('home')}}" type="button" class="btn btn-secondary form-control" style="border-radius: 20px;" role="button">@lang('buttons.goBack')</a>
        @else
            <a href="{{ route('note.download', ['note' => $note->id])}}" type="button" role="button" class="btn btn-download form-control mb-1">@lang('buttons.download')</a>
            <a href="{{ route('home')}}" type="button" class="btn btn-secondary form-control" style="border-radius: 20px;" role="button">@lang('buttons.goBack')</a>
        @endif
    @else
    <a href="{{ route('login') }}" type="button" role="button" class="btn btn-download form-control mb-1">@lang('buttons.download')</a>
    <a href="{{ route('home')}}" type="button" class="btn btn-secondary form-control" style="border-radius: 20px;" role="button">@lang('buttons.goBack')</a>
    @endauth
@endsection