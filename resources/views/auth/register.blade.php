@extends('layouts.app')

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ url('/') }}/js/myScript.js"></script>

@section('breadcrumb')
<a class="breadcrumb-item ms-auto" aria-current="page" class="nav-link" href="{{ route('home')}}">@lang('labels.home')</a>
<li class="breadcrumb-item active" aria-current="page">@lang('labels.signUp')</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('user.register')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">@lang('user.name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">@lang('user.lastName')</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="employment" class="col-md-4 col-form-label text-md-end">@lang('user.employment')</label>

                            <div class="col-md-6">
                                <select class="form-select mb-3" name='employment'>
                                    <option selected="selected" value="">@lang('user.employment')</option>
                                    <option value="Studente">Studente</option>
                                    <option value="Professore">Professore</option>
                                </select>

                                @error('employment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="faculty" class="col-md-4 col-form-label text-md-end">@lang('user.faculty')</label>

                            <div class="col-md-6">
                                <select id="faculty" class="w-100 form-select mb-3" name='faculty'>
                                <option selected="selected" value="">@lang('note.faculty')</option>
                                <option value="1">Ingegneria Informatica</option>
                                <option value="2">Ingegneria Elettronica</option>
                                <option value="3">Ingegneria Civile</option>
                                <option value="4">Ingegneria dell'Automazione Industriale</option>
                                <option value="5">Ingegneria delle Tecnologie per l'Impresa Digitale</option>
                                <option value="6">Ingegneria Gestionale</option>
                                <option value="7">Ingegneria Meccanica e dei Materiali</option>
                                <option value="8">Ingegneria per l'Ambiente e il Territorio</option>
                                <option value="9">Sistemi Agricoli Sostenibili</option>
                                <option value="10">Banca e Finanza</option>
                                <option value="11">Economia e Azienda Digitale</option>
                                <option value="12">Economia e Gestione Aziendale</option>
                                <option value="13">Assistenza Sanitaria</option>
                                <option value="14">Biotecnologie</option>
                                <option value="15">Dietistica</option>
                                <option value="16">Educazione Professionale</option>
                                <option value="17">Fisioterapia</option>
                                <option value="18">Igiene Dentale</option>
                                <option value="19">Infermieristica</option>
                                <option value="20">Ostetricia</option>
                                <option value="21">Scienze Motorie</option>
                                <option value="22">Tecnica della Riabilitazione Psichiatrica</option>
                                <option value="23">Tecniche della Prevenzione nell'Ambiente e nei Luoghi di Lavoro</option>
                                <option value="24">Tecniche di Laboratorio Biomedico</option>
                                <option value="25">Tecniche di Radiologia Medica, per Immagini e Radioterapia</option>
                                </select>

                                <!-- <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}" required autocomplete="faculty" autofocus> -->

                                <!-- @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">@lang('user.email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">@lang('user.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">@lang('user.confirmPassword')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                @lang('user.register')
                                </button>
                                <a href="{{ route('home')}}" type="button" class="btn btn-secondary" role="button">@lang('buttons.goBack')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
