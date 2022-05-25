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

@section('corpo')
<div class="container">
    <!-- Filters -->
    <form name="filter" method="get" action="{{ route('filter') }}" enctype="multipart/form-data">
    @csrf
    
<div class="row justify-content-center pt-5">
        <div class="w-100 col text-center">
            <select id="department" name="department" class="form-select" onchange="if (this.selectedIndex) filter_faculties()">
                <option selected="selected" value="">@lang('note.department')</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{$department->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-100 col text-center">
            <select id="faculty" name="faculty" class="form-select">
                <option selected="selected" value="">@lang('note.faculty')</option>
                @foreach($faculties as $faculty)
                    <option value=" {{ $faculty->id }}">{{$faculty->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-100 col text-center">
            <select id="year" name="year" class="form-select">
                <option selected="selected" value="">@lang('note.year')</option>
                @for ($i = 2022; $i >= 2000; $i--)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="w-100 col text-center">
            <select id="score" name="score" class="col form-select">
                <option selected="selected" value="">@lang('note.score')</option>
                @for ($i = 1; $i <= 5; $i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="col text-center">
            <input id="mySubmit" type="submit" value="@lang('buttons.filter')" class="btn btn-primary btn-sm" role="button">
        </div>
    </div>
    </form>

    <div class="row pb-3 pt-3">
        <hr/>
    </div>

    <div class="table-responsive">
        <table id="myTable" class="table table-hover bg-white dt-responsive nowrap" style="border-radius: 10px;">
            <thead>
              <tr>
                <th scope="col"><i class="bi bi-star-fill text-warning" fill="currentColor"></i></th>
                <th scope="col">@lang('note.title')</th>
                <th scope="col">@lang('note.course')</th>
                <th scope="col">@lang('note.writer')</th>
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
                <td>{{ $note->writer->name }} {{ $note->writer->lastname }}</td>
                <td>{{ $note->num_pages }}</td>
                <td><a href="{{ route('note.details', ['note' => $note->id]) }}" class="btn btn-primary-see-more btn-sm active" role="button" style="border-radius: 20px;"> @lang('buttons.details') <i class="bi bi-chevron-right"></i></i></a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>

</div>

@endsection