@extends('layouts.master')

@section('titolo', 'UniBS Notes')

@section('stile', 'style.css')

@section('left_navbar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home')}}"><i class="bi bi-journal-text"></i> @lang('labels.notes') </a>
    </li>
@endsection

@section('right_navbar')
    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-book"></i>
            @lang('labels.myNotes') 
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.mynotes.downloaded') }}">@lang('labels.downloaded')</a>
                <a class="dropdown-item" href="{{ route('user.mynotes.uploaded') }}">@lang('labels.uploaded')</a>
            </div>
        </li>

        <a href="{{ route('profile.show') }}" class="btn btn-outline-myviolet my-2 my-sm-0" type="submit" role="button">{{ Auth::user()->name }}</a>
        
         <li class="nav-item dropdown-sm">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-globe text-primary" color="currentColor"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('setLang', ['lang' => 'en']) }}"><img src="{{ url('/') }}/img/gb.png"/> @lang('labels.en')</a>
                <a class="dropdown-item" href="{{ route('setLang', ['lang' => 'it']) }}"><img src="{{ url('/') }}/img/it.png"/> @lang('labels.it')</a>
            </div> 
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> @lang('labels.login')</a>
        </li> 

        <a href="{{ route('register') }}" class="btn btn-outline-myviolet my-2 my-sm-0" type="submit" role="button"><i class="bi bi-person-fill"></i> @lang('labels.signUp')</a>
        
         <li class="nav-item dropdown-sm">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-globe text-primary" color="currentColor"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('setLang', ['lang' => 'en']) }}"><img src="{{ url('/') }}/img/gb.png"/> @lang('labels.en')</a>
                <a class="dropdown-item" href="{{ route('setLang', ['lang' => 'it']) }}"><img src="{{ url('/') }}/img/it.png"/> @lang('labels.it')</a>
            </div> 
        </li>    
        @endauth       
@endsection

@section('titolo', 'UniBS Notes')

@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
<a class="breadcrumb-item" aria-current="page" class="nav-link" href="{{ route('note.details', ['note'=> $note_id]) }}">@lang('breadcrumb.noteDetails')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.writer')</li>
@endsection

@section('corpo')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card" style="border-radius: 5px;">
                <div class="card-body p-4">
                    <div class="row text-black align-items-center">

                        <div class="col-5 mx-auto">
                            <img src="{{ asset('storage/profile_images/'.$writer->image) }}" class="img-fluid" style="width: 170px; border-radius: 70px;">
                        </div>

                        <div class="col-7">
                            <div class="row">
                                <h5 class="mb-1 ">{{ $writer->name }} {{ $writer->lastname }}</h5>
                            </div>
                            <div class="row">
                                <p style="color: #2b2a2a;">{{ $writer->faculty->department->name }} <i class="bi bi-dot"></i> {{ $writer->faculty->name }}</p>
                            </div>
                                                
                            <div class="row justify-content-evenly rounded p-2" style="background-color: #efefef;">
                                <div class="col-4 text-center">
                                    <p class="small text-muted mb-0">@lang('mynotes.notes')</p>
                                    <p class="mb-0">{{ $writer->writtenNotes->count() }}</p>
                                </div>
                                <div class="col-4 text-center">
                                    <p class="small text-muted mb-0">@lang('mynotes.followers')</p>
                                    <p class="mb-0">{{ $writer->followingUser->count() }}</p>
                                </div>
                                <div class="col-4 text-center">
                                    <p class="small text-muted mb-0">@lang('mynotes.rating')</p>
                                    <p class="mb-0">{{round($rating, 1)}}</p>
                                </div>
                            </div>

                            @auth
                            <div class="row justify-content-center p-3">
                                @if($writer->followedBy(Auth::user()->id))
                                <a href="{{ route('writer.unfollow', ['user' => $writer->id]) }}" type="button" role="button" class="btn btn-danger btn-block form-control" style="border-radius: 20px;">@lang('buttons.unfollow')</a>
                                <a href="{{ route('note.details', ['note'=> $note_id]) }}" type="button" role="button" class="btn btn-secondary btn-block form-control mt-1" style="border-radius: 20px;">@lang('buttons.goBack')</a>
                                @elseif($writer->id == Auth::user()->id)
                                <a href="{{ route('note.details', ['note'=> $note_id]) }}" type="button" role="button" class="btn btn-secondary btn-block form-control mt-1" style="border-radius: 20px;">@lang('buttons.goBack')</a>
                                @else
                                <div class="row justify-content-between p-0">
                                    <div class="col-10 p-0">
                                        <a href="{{ route('writer.follow', ['user' => $writer->id]) }}" type="button" role="button" class="btn btn-primary btn-block form-control" style="border-radius: 20px;">@lang('buttons.follow')</a>
                                    </div>
                                    <div class="col-2">
                                        <!-- Button trigger modal -->                                       
                                        <button type="button" class="btn btn-light btn-small" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi bi-info-circle"></i>
                                        </button>
                                    </div>                                

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Segui autore</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Se scegli di seguire un autore riceverai una mail per ogni sua pubblicazione.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <div class="row justify-content-left p-0">
                                    <div class="col-10 p-0 ms-2">
                                        <a href="{{ route('note.details', ['note'=> $note_id]) }}" type="button" role="button" class="btn btn-secondary btn-block form-control mt-1" style="border-radius: 20px;">@lang('buttons.goBack')</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @else
                            <div class="row justify-content-center p-3">
                                <a href="{{ route('note.details', ['note'=> $note_id]) }}" type="button" role="button" class="btn btn-secondary btn-block form-control mt-1" style="border-radius: 20px;">@lang('buttons.goBack')</a>
                            </div>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container pt-3 gx-5 gy-3 justify-content-center">
    <div class="table-responsive">
        <table id="myTable" class="table table-hover bg-white dt-responsive nowrap" style="border-radius: 10px;">
            <thead>
            <tr>
                <th scope="col"><i class="bi bi-star-fill text-warning" fill="currentColor"></i></th>
                <th scope="col">@lang('note.title')</th>
                <th scope="col">@lang('note.course')</th>
                <th scope="col">@lang('note.numberOfPages')</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($writer->writtenNotes as $writtenNote)
            <tr>
                <th scope="row">{{ round($writtenNote->average_score, 1) }}</th>
                <td>{{ $writtenNote->title }}</td>
                <td>{{ $writtenNote->course }}</td>
                <td>{{ $writtenNote->num_pages }}</td>
                <td><a href="{{ route('note.details', ['note' => $writtenNote->id]) }}" class="btn btn-primary-see-more btn-sm active" role="button" style="border-radius: 20px;"> @lang('buttons.details') <i class="bi bi-chevron-right"></i></i></a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection