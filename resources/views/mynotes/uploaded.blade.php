@extends('layouts.mynotes')

@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.notesUploaded')</li>
@endsection

@section('message')
<!-- @if(isset($message)) -->
<!-- <div class="col col-12">
    <div class="card card-responsive popup-message mb-3 alert alert-success alert-dismissible text-center" id="msg">
        <strong id="msg_text">Ciao</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="close"></button>
    </div>
</div> -->
<div class="col">
    <h1> ciao </h1>
</div>


<!-- @endif -->
@endsection

@section('cards')
<div class="col-xl-3 col-sm-6 col-12"> 
    <div class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row justify-content-evenly">
                    <div class="col-3 align-self-center">
                        <h1 class="bi bi-file-earmark-arrow-up-fill text-primary" fill="currentColor"></h1>
                    </div>

                    <div class="col-9">
                        <div class="row">
                            <h3 class="text-end">{{ Auth::user()->writtenNotes->count() }}</h3>
                        </div>
                        <div class="row">
                            <span class="text-end">@lang('mynotes.notesUploaded')</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-sm-6 col-12"> 
    <div class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row justify-content-evenly">
                    <div class="col-3 align-self-center">
                        <h1 class="i bi-star-fill text-warning" fill="currentColor"></h1>
                    </div>

                    <div class="col-9">
                        <div class="row">
                            <h3 class="text-end">{{round($rating, 1)}}</h3>
                        </div>
                        <div class="row">
                            <span class="text-end">@lang('mynotes.rating')</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-sm-6 col-12"> 
    <div class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row justify-content-evenly">
                    <div class="col-3 align-self-center">
                        <h1 class="bi bi-chat-square-heart-fill text-danger" fill="currentColor"></h1>
                    </div>

                    <div class="col-9">
                        <div class="row">
                            <h3 class="text-end">{{ Auth::user()->followingUser->count() }}</h3>
                        </div>
                        <div class="row">
                            <span class="text-end">@lang('mynotes.followers')</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('button')
<a href="{{ route('note.create') }}" class="btn btn-download" role="button" autocomplete="off">@lang('buttons.uploadNewNote')</a>
@endsection

@section('table')
<div class="table-responsive">
    <table id="myTable" class="table table-hover bg-white dt-responsive nowrap" style="border-radius: 10px;">
        <thead>
            <tr>
            <th scope="col"><i class="bi bi-star-fill text-warning" fill="currentColor"></i></th>
            <th scope="col">@lang('note.title')</th>
            <th scope="col">@lang('note.course')</th>
            <th scope="col"># @lang('note.pages')</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($notesList as $note)
            <tr>
            <th scope="row">{{ round($note->average_score, 1) }}</th>
            <td>{{ $note->title }}</td>
            <td>{{ $note->course }}</td>
            <td>{{ $note->num_pages }}</td>
            <td><a href="{{ route('user.mynotes.myuploadednote', ['note' => $note->id]) }}" class="btn btn-primary-see-more btn-sm active" role="button" style="border-radius: 20px;"> @lang('buttons.details') <i class="bi bi-chevron-right"></i></i></a></td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection