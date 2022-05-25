@extends('layouts.note')


@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
<a class="breadcrumb-item active" aria-current="page" class="nav-link" href="{{ route('user.mynotes.downloaded') }}">@lang('breadcrumb.notesDownloaded')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.noteDetails')</li>
@endsection

@section('column')
<form name="note_score" method="get" action="{{ route('note.score', ['note' => $note->id]) }}" enctype="multipart/form-data">
@csrf

<div class="p-3 border border-warning bg-white" style="border-radius: 20px;">
    <h6>@lang('mynotes.myRating')</h6>
    <div class="row p-3 justify-content-evenly">
        <div class="col-6">
            <h4 class="bi bi-star-fill text-warning" fill="currentColor"></h4>
        </div>
    
            <div class="col-6">
                <select id="selectVoto" style="width:auto;" class="form-select" name="score">
                    <option selected="selected" value="{{ $note->getScore() }}">{{ $note->getScore() }}</option>
                    @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{$i}}</option>
                    @endfor
                </select>
            </div>  

    </div>
</div>

<div class="row p-3 pb-1">
    <input id="mySubmit" type="submit" class="btn btn-download form-control rounded-pill" role="button" value="@lang('buttons.vote')">
</div>

<div class="row p-3 pt-0">
    <a href="{{ route('user.mynotes.downloaded', ['note'=> $note->id]) }}" class="btn btn-secondary form-control rounded-pill" role="button">@lang('buttons.goBack')</a>
</div>
</form> 

@endsection
