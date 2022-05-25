<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UniBS Notes</title>

    <!-- Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-1">
            <div class="container">
        
                <a class="navbar-brand" href="#">UNIBS <i class="bi bi-pencil-square text-primary" fill="currentColor"></i> NOTES</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home')}}"><i class="bi bi-journal-text"></i> @lang('labels.notes') </a>
                            </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
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
                    </ul>
                </div>

            </div>
        </nav>
        
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
