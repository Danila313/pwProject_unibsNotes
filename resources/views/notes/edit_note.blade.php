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

@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">Home</a>
<a class="breadcrumb-item" aria-current="page" class="nav-link" href="{{ route('user.mynotes.uploaded') }}">@lang('breadcrumb.notesUploaded')</a>
<a class="breadcrumb-item" aria-current="page" class="nav-link" href="{{ route('user.mynotes.myuploadednote', ['note'=> $note->id]) }}">@lang('breadcrumb.noteDetails')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.edit')</li>
@endsection

@section('corpo')
<form name="note" method="get" action="{{ route('note.update', ['note' => $note->id ]) }}" enctype="multipart/form-data">
@csrf

<div class="container">
    <div class="row justify-content-evenly">
      
      <div class="col-7">
        <div class="p-3 border bg-white">
            <h4>@lang('note.abstract')</h4>
            <div class="input-group">
                <input type="text" id="abstract" class="form-control" name="abstract" value="{{ $note->abstract }}"/>
            </div>
          </div>
      </div>
  
      <div class="col-5">
        <div class="p-3 border bg-white">
          <h4>@lang('mynotes.docDetails')</h4>

          <div class="row justify-content-evenly pb-3">
              <div class="col-4 align-self-center">
                  <h6 class="text-secondary">@lang('note.title')</h6>
              </div>
              <div class="col-8 text-end">
                <div class="input-group">
                    <input id="title" type="text" class="form-control" placeholder="{{ $note->title }}" name="title" value="{{ $note->title }}">
                </div>
              </div>
              <span class="error text-danger text-sm text-end fs-6" id="invalid-title">
              </span>
          </div>
          
          <div class="row justify-content-evenly">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.department')</h6>
            </div>
            <div class="col-8 text-end">
                <select class="form-select mb-3" name="department" id="department" onchange="if (this.selectedIndex) filter_faculties()">
                    <option selected="selected" value="{{ $note->faculty->department->id }}">{{ $note->faculty->department->name }}</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>
            <span class="error text-danger text-sm text-end fs-6" id="invalid-department">
            </span>
        </div> 

        <div class="row justify-content-evenly">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.faculty')</h6>
            </div>
            <div class="col-8 text-end">
                <select id="faculty" class="w-100 form-select mb-3" name="faculty">
                    <option selected="selected" value="{{ $note->faculty->id }}">{{ $note->faculty->name }}</option>
                    @foreach($faculties as $faculty)
                        <option value=" {{ $faculty->id }}">{{$faculty->name}}</option>
                    @endforeach
                </select>
            </div>
            <span class="error text-danger text-sm text-end fs-6" id="invalid-faculty">
            </span>
        </div> 

        <div class="row justify-content-evenly  pb-3">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.course')</h6>
            </div>
            <div class="col-8 text-end">
                <div class="input-group">
                    <input id="course" type="text" class="form-control" placeholder="{{ $note->course }}" name="course" value="{{ $note->course }}">
                </div>
            </div>
            <span class="error text-danger text-sm text-end fs-6" id="invalid-course">
            </span>
        </div> 

        <div class="row justify-content-evenly pb-3">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.professor')</h6>
            </div>
            <div class="col-8 text-end">
                <div class="input-group">
                    <input id="professor" type="text" class="form-control" placeholder="{{ $note->professor }}" name="professor" value="{{ $note->professor }}">
                </div>
            </div>
            <span class="error text-danger text-sm text-end fs-6" id="invalid-professor">
            </span>
        </div> 

        <div class="row justify-content-evenly">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.year')</h6>
            </div>
            <div class="col-8 text-end">
                <select style="width:auto;" class="form-select mb-3" name="year">
                    <option selected="selected" value="{{ $note->year }}">{{ $note->year }}</option>
                    @for ($i = 1900; $i <= 2022; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div> 

        <div class="row justify-content-evenly pb-3">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.pages')</h6>
            </div>
            <div class="col-8 text-end">
                <div class="input-group">
                    <input id="pages" type="text" class="form-control" placeholder="{{ $note->num_pages }}" value="{{ $note->num_pages }}" name="pages">
                </div>
            </div>
            <span class="error text-danger text-sm text-end fs-6" id="invalid-pages">
            </span>
        </div> 

        <div class="row justify-content-evenly">
            <div class="col-4 align-self-center">
                <h6 class="text-secondary">@lang('note.file')</h6>
            </div>
            <div class="col-8 text-end">
                <span>{{ $note->file }}</span>
            </div>
        </div> 
        
        </div>
      </div>
  
    </div>

    <div class="row justify-content-end pt-3 pb-1">
        <div class="col-5 text-center">
                <input id="mySubmit" type="submit" value="@lang('buttons.saveChanges')" class="btn btn-download form-control rounded-pill" role="button" onclick="event.preventDefault(); checkNote()">
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-5 text-center">
            <a href="{{ route('user.mynotes.myuploadednote', ['note'=>$note->id]) }}" class="btn btn-secondary form-control rounded-pill" role="button">@lang('buttons.goBack')</a>
        </div>
    </div>
    
</div>
</form>
@endsection
