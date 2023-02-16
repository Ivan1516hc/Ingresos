<!doctype html>
<html lang="en">
  <head>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6858343273703359"
     crossorigin="anonymous"></script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>INGRESOS</title>

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

</head>
<body>
  
  <!--Topbar -->
    <div class="topbar transition">
        <div class="bars">
            <button type="button" class="btn transition" id="sidebar-toggle">
                <i class="las la-bars"></i>
            </button>
        </div>
        <div class="menu">
            <ul>
                <li>
                    <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox"  title="Dark Or White"/>
                                <div class="slider round"></div>
                        </label>
                        </div>
                    </li>
                    <li>
                        <a href="notifications.html" class="transition">
                            <i class="las la-bell"></i>
                            <span class="badge badge-danger notif">5</span>
                        </a>
                    </li>
                <li>
                    <div class="dropdown">
                        <div class="dropdown-toggle" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            {{-- <img src="assets/images/avatar/avatar-2.png" alt="Profile"> --}}
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownProfile">
                            
                            <a class="dropdown-item" href="profile.html">
                                <i class="las la-user mr-2"></i> PERFIL
                            </a>

                            {{-- <a class="dropdown-item" href="activity-log.html">
                                <i class="las la-list-alt mr-2"></i> Activity Log
                            </a> --}}
                        
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout">
                                <i class="las la-sign-out-alt mr-2"></i> SALIR
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
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
	<script src="/bootstrap/js/jquery.min.js"></script>
	<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/bootstrap/js/popper.min.js"></script>
	<script src="/assets/script.js"></script>
 </body>
</html>