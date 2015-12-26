<html>
<head>
	<link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-313.css">
</head>

<body>
	<nav class="navbar navbar-default" role="navigation">
		<a class="navbar-brand" href="#">TorrFlix</a>
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="{{ url('/') }}">Home</a>
			</li>
		</ul>

		@if(Auth::user())
		<ul class="nav navbar-nav pull-right">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Profile</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="{{ url('/logout') }}">Logout</a></li>
			</ul>
		</li>
		</ul>
		@else
		<ul class="nav navbar-nav pull-right">
			<li>
				<a href="{{ url('login') }}">Login</a>
			</li>
			<li>
				<a href="{{ url('signup') }}">Signup</a>
			</li>
		</ul>		
		@endif
	</nav>
	<div class="col-md-10 col-md-offset-1">
		@yield('content')
	</div>
	<script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>