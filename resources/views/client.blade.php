<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title inertia>{{ config('app.name', 'Regcalls') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800,800i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Arizonia" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,300i,400,400i,500,500i,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700" rel="stylesheet">

        <!-- Fontawesome -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">

        <!-- Slick css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick-theme.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.css')}}">

        <!-- Flaticon icon -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flaticon.css')}}">

        <!-- Themify icon -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">

        <!-- Animate icon -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">

        <!-- Bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">

        <!-- Color css -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style14.css')}}" id="color">

        <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        <!-- latest jquery-->
        <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" ></script>

        <!-- popper js-->
        <script src="{{asset('assets/js/popper.min.js')}}" ></script>

        <!-- Bootstrap js-->
        <script src="{{asset('assets/js/bootstrap.js')}}" ></script>

        <!-- slick js-->
        <script src="{{asset('assets/js/slick.js')}}" ></script>

        <!-- Bootstrap js-->
        <script src="{{asset('assets/js/portfolio.js')}}" ></script>

        <!-- Menu js -->
        <script src="{{asset('assets/js/menu.js')}}"></script>

        <!-- bootstrap-notify js -->
        <script src="{{asset('assets/js/bootstrap-notify.min.js')}}"></script>

        <!-- Custome scripts js-->
        <script src="{{asset('assets/js/custom-scripts.js')}}"></script>
        <script src="{{asset('assets/js/multi-cat-two-timer.js')}}"></script>
    </body>

</html>
