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
                <a class="dropdown-item" href="{{ route('note.create') }}">@lang('labels.create')</a>
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

@section('corpo')
<div class="container">
    
  <div class="row gx-5 gy-3 justify-content-center">
    @yield('message')
    
    <div class="col-8">
      <div class="p-3 border bg-white">
          <h3>{{ $note->title }}</h3>
          <hr class="text-white"/>
          <h6 class="text-secondary">Area: <b>{{ $note->faculty->department->name }}</b></h6>
          <h6 class="text-secondary">Corso di Studi: <b>{{$note->faculty->name }}</b></h6>
          <hr/>
          <h6 class="text-secondary">Corso: <b>{{ $note->course }}</b></h6>
          <h6 class="text-secondary">Professore: <b>{{ $note->professor }}</b></h6>
          <h6 class="text-secondary">Anno Accademico: <b>{{ $note->year }}</b></h6>
          <hr/>
          <h6 class="text-black"><i class="bi bi-file-earmark text-black"></i> {{ $note->num_pages }} @lang('note.pages')</h6>
      </div>

      <div class="mt-3 p-3 border bg-white">
        <h5>@lang('note.abstract')</h5>
        <p>{{ $note->abstract }}</p>
      </div>

    </div>

    <div class="col-3">
      <div class="mb-3 p-3 border bg-white" style="border-radius: 20px;">
        <h5 class="text-center">
            <i class="bi bi-star-fill text-warning" fill="currentColor"></i> {{ $note->average_score }}</h5>
        <hr/>
        <h6 class="text-center">@lang('note.uploadedOn') {{ \Illuminate\Support\Str::limit($note->created_at, 10, $end='') }} DA</h6>
        <h5><a class="nav-link text-center" href="{{ route('note.writer', ['note_id'=> $note->id])}}"><i class="bi bi-person-circle"></i> {{ $note->writer->name }} {{ $note->writer->lastname }}</a></h5>    
      </div>
      @yield('column')
    </div>
    
    <!-- <div class="col-8">
      <div class="p-3 border bg-white">
        <h5>@lang('note.abstract')</h5>
        <p>{{ $note->abstract }}</p>
      </div>
    </div> -->

    <!-- <div class="col-3">
        @yield('column')
    </div> -->

  </div>
</div>

@endsection