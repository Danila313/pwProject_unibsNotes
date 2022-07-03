@extends('layouts.note')


@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
<a class="breadcrumb-item active" aria-current="page" class="nav-link" href="{{ route('user.mynotes.uploaded') }}">@lang('mynotes.notesUploaded')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.noteDetails')</li>
@endsection

@section('message')
@if(isset($succ))
<div class="row justify-content-md-center">
    <div class="col-6">
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill pr-1"></i>
            <div class="ms-1">{{ $succ }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@endsection


@section('column')
<div class="row p-3 pb-0 pt-0">
    <a href="{{ route('note.edit', ['note'=> $note->id]) }}" class="btn btn-download form-control rounded-pill" role="button">@lang('buttons.edit')</a>
</div>
<div class="row p-3 pt-1 pb-1">
    <a id="delete_note" href="{{ route('note.delete', ['note'=>$note->id]) }}" class="btn btn-danger form-control rounded-pill" role="button" onclick="event.preventDefault(); confirm_note_deletion();">@lang('buttons.delete')</a>
</div>
<div class="row p-3 pt-0">
    <a href="{{ route('user.mynotes.uploaded', ['note'=> $note->id]) }}" class="btn btn-secondary form-control rounded-pill" role="button">@lang('buttons.goBack')</a>
</div>
@endsection

