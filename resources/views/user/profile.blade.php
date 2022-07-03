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
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('breadcrumb.myProfile')</li>
@endsection

@section('corpo')
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

    <div class="container">
      <div class="row d-flex justify-content-center align-items-center h-100 pt-3">
        <div class="col col-lg-8 mb-4 mb-lg-0">
          <div class="card mb-3 bg-white" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white p-4" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img
                  src="{{ asset('storage/profile_images/'.Auth::user()->image) }}"
                  class="img-fluid my-5 rounded-circle"
                  style="width: 120px;"
                />
                <h4>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h4>
                <p>{{ Auth::user()->employment }}</p>
                <div class="row justify-content-center align-items-end">
                    <div class="col-10">
                        <a href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); confirm_logout();"
                            type="button" class="btn btn-primary btn-block form-control btn-sm" style="border-radius: 20px;">
                            <i class="bi bi-box-arrow-left"></i>  @lang('buttons.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h5>@lang('labels.information')</h5>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>@lang('labels.email')</h6>
                      <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>
                  </div>
                  <h5>@lang('labels.university')</h5>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>@lang('note.department')</h6>
                      <p class="text-muted">{{ Auth::user()->faculty->department->name }}</p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>@lang('note.faculty')</h6>
                      <p class="text-muted">{{ Auth::user()->faculty->name }}</p>
                    </div>
                  </div>
                  <div class="row pt-1 justify-content-center pb-1">
                    <div class="col-10">
                        <a href="{{ route('profile.edit') }}" type="button" class="btn btn-download btn-block form-control" style="border-radius: 20px;">@lang('buttons.edit')</a>
                    </div>
                  </div>
                  <div class="row pt-1 justify-content-center">
                    <div class="col-10">
                        <a href="{{ route('home') }}" type="button" class="btn btn-secondary btn-block form-control" style="border-radius: 20px;">@lang('buttons.goBack')</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
