<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6858343273703359"
     crossorigin="anonymous"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Bootstrap CSS-->
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <!-- Style CSS (White)-->
	<link rel="stylesheet" href="/css/White.css">
	<!-- Style CSS (Dark)-->
	<link rel="stylesheet" href="/css/Dark.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="/fontawesome/css/all.css">
    <!-- Icon LineAwesome CSS-->
	<link rel="stylesheet" href="/lineawesome/css/line-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="/bootstrap/js/jquery.min.js"></script>
</head>
<body>
        <main>
            @yield('content')
        </main>

        <!-- Loader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<div class="loader-overlay"></div>

	<!-- Library Javascipt-->
	
	<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/bootstrap/js/popper.min.js"></script>
	<script src="/assets/script.js"></script>

</body>
</html>
