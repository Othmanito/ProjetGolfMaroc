<!-- la partie head provient d'un autre fichier -->
@include('layouts/parts/_head_admin')

<body>

	<div id="wrapper">

		<div id="page-wrapper">

			<div class="container-fluid">

				@yield('main')

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('js/jquery.js') }}"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
