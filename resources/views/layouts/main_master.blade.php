<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{{{ asset('images/golfmaroc.png') }}}">

	{{-- Title goes here --}}
	<title>@yield('title')</title>

	{{-- Styles --}}
	@yield('styles')

</head>
<body>
	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

			@yield('menu_1')

			@yield('menu_2')

		</nav>
		<!-- end Navigation -->

		<!-- Main Page -->
		<div id="page-wrapper">

		@yield('main_content')

		</div>
		<!-- end Main Page -->
	</div>


	{{-- Scripts --}}
	@yield('scripts')
</body>
</html>
