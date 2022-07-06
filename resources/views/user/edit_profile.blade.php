@extends('layouts.master')

@section('titolo', 'UniBS Notes')

@section('stile', 'style.css')

@section('left_navbar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home')}}"><i class="bi bi-search"></i> @lang('labels.search') </a>
    </li>
@endsection

@section('right_navbar')
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
@endsection

@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">Home</a>
<a class="breadcrumb-item" aria-current="page" class="nav-link" href="{{ route('profile.show') }}">@lang('breadcrumb.myProfile')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.edit')</li>
@endsection

@section('corpo')
<form name="note" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
@csrf

    <div class="container">
      <div class="row d-flex justify-content-center align-items-center h-100 pt-3">
        <div class="col col-lg-8 mb-4 mb-lg-0">
          <div class="card mb-3 bg-white" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img
                  src="{{ asset('storage/profile_images/'.Auth::user()->image) }}"
                  alt="Avatar"
                  class="img-fluid my-4 rounded-circle"
                  style="width: 120px;"
                />
                <div class="row justify-content-center pb-5">
                  <div class="col-8">
                    <label for="profile_image" class="form-label" >@lang('user.changeImage')</label>
                    <input class="form-control form-control-sm" id="profile_image" type="file" name="profile_image">
                  </div>
                </div>
                <h4>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h4>
                <div class="row justify-content-center">
                    <div class=col-8>
                        <select class="form-select mb-3" name='employment'>
                            <option selected>{{ Auth::user()->employment }}</option>
                            <option value="Studente">Studente</option>
                            <option value="Professore">Professore</option>
                        </select>
                    </div>
                </div>
                <i class="far fa-edit mb-5"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h5>@lang('labels.information')</h5>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>@lang('labels.email')</h6>
                      <div class="input-group mb-3">
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                      </div>
                    </div>
                  </div>
                  <h5>@lang('labels.university')</h5>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>@lang('note.department')</h6>
                        <div class="col-8">
                            <select class="form-select mb-3" name='department' id="department" onchange="if (this.selectedIndex) filter_faculties()">
                                <option selected = "selected" value = "{{ Auth::user()->faculty->department->id }}">{{ Auth::user()->faculty->department->name }}</option>
                                @foreach($departments as $department)
                                  <option value="{{ $department->id }}" >{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>@lang('note.faculty')</h6>
                        <div class="col-12">
                            <select class="w-100 form-select mb-3" id="faculty" name='faculty_id'>
                                <option selected = "selected" value = "{{ Auth::user()->faculty->id }}">{{ Auth::user()->faculty->name }}</option>
                                @foreach($faculties as $faculty)
                                  <option value=" {{ $faculty->id }}">{{$faculty->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row pt-1 justify-content-center">
                    <div class="col-10 pb-1">
                        <input id="mySubmit" type="submit" value="@lang('buttons.saveChanges')" class="btn btn-download btn-block form-control pb-1" role="button" style="border-radius: 20px;">
                    </div>
                  </div>
                  <div class="row pt-1 justify-content-center">
                    <div class="col-10">
                        <a id="go_back" href="{{ route('profile.show') }}" type="button" class="btn btn-secondary btn-block form-control" style="border-radius: 20px;" onclick="event.preventDefault(); confirm_go_back();">@lang('buttons.goBack')</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</form>
@endsection
