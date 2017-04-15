<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-ba"></span>
				</button>
		<a class="navbar-brand" href="./admin">GolfMaroc</a>
	</div>

	<!--  Begin Top Menu -->
	<ul class="nav navbar-right top-nav">

		<!--  Messages -->
		@yield('content_messages')

		<!--  Alerts -->
		@yield('content_alerts')

		<!--  Other -->
		@yield('content_compte')

	</ul>

	<!--  end Top Menu -->


</nav>
<!-- Fin des Menu -->
