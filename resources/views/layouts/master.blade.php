<!DOCTYPE html>

<html>

    <head>
        <meta charset='utf-8'>
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        
        <!-- Fogli di stile -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">
        
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="{{ url('/') }}/js/myScript.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        
        <script type="text/javascript" class="init">

            $(document).ready(function () {
                $('#myTable').DataTable();
            });

        </script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-1">
            <div class="container">
        
                <a class="navbar-brand" href="#">UNIBS <i class="bi bi-pencil-square text-primary" fill="currentColor"></i> NOTES</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @yield('left_navbar')
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @yield('right_navbar')
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
        
        @yield('corpo')  

    </body>

</html>