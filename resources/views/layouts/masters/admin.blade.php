<!-- la partie head provient d'un autre fichier -->
@include('layouts.heads._head_admin')

<body>

	<div id="wrapper">

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            	@include('layouts.menus_1._nav_admin')
            </ul>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
				@include('layouts.menus_2._nav_admin')
            </div>
		</nav>



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

	<script src="table/jquery.js"></script>
	<script src="table/jquery.dataTables.js"></script>
	<script src="table/dataTables.bootstrap.js"></script><!-- next and previous -->
	<!--script src="table/dataTables.responsive.js"></script-->


	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
	$(document).ready(function() {
			$('#dataTables-example').DataTable({
					responsive: true
			});
	});
	</script>

</body>

</html>
