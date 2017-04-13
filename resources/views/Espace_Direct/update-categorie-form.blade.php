@extends('layouts.main_master')

@section('title') Modifier Categorie @endsection

@section('styles')
<link href="{{  asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{  asset('css/sb-admin.css') }}" rel="stylesheet">
<link href="{{  asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<script src="{{  asset('js/jquery.js') }}"></script>
<script src="{{  asset('js/bootstrap.js') }}"></script>
@endsection

@section('main_content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Modifier une Categorie <small> </small></h1>

		<div id="page-wrapper">

			<div class="container-fluid">

				{{-- **************Alerts**************  --}}
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-8">
						{{-- Debut Alerts --}}
						@if (session('alert_success'))
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_success') !!}
						</div>
						@endif

						@if (session('alert_info'))
						<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_info') !!}
						</div>
						@endif

						@if (session('alert_warning'))
						<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_warning') !!}
						</div>
						@endif

						@if (session('alert_danger'))
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_danger') !!}
						</div>
						@endif
						{{-- Fin Alerts --}}
					</div>

					<div class="col-lg-2"></div>
				</div>
				{{-- **************endAlerts**************  --}}

					{{-- *************** formulaire ***************** --}}
					<form role="form" method="post" action="{{ Route('direct.submitUpdate',['param' => 'categorie']) }}">
						{{ csrf_field() }}

						<input type="hidden" class="form-control" name="id_categorie" value="{{ $data->id_categorie }}" >

						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-6">
								{{-- Libelle --}}
								<div class="form-group">
									<label>Nom de la Categorie</label>
									<input type="text" class="form-control" placeholder="Libelle " name="libelle" value="{{ $data->libelle }}" required autofocus>
								</div>
							</div>

							<div class="col-lg-6">
								{{-- Description --}}
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="3" placeholder="Description" name="description">{{ $data->description }}</textarea>
								</div>
							</div>

						</div>
						<!-- end row 1 -->


						<!-- row 4 -->
						<div class="row">

							<div class="col-lg-4"></div>
							<div>
								{{-- Submit & Reset --}}
								<button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
								<button type="submit" name="submit" value="verifier" class="btn btn-default" disabled>Vérifier</button>
								<button type="reset" class="btn btn-default">Réinitialiser</button>
							</div>

						</div>
						<!-- end row 4 -->

					</form>

			</div>
			<!-- /#page-wrapper -->
		</div>
	</div>
</div>
	<!-- /.row -->
@endsection


@section('menu_1')
	@include('Espace_Direct._nav_menu_1')
@endsection

@section('menu_2')
	@include('Espace_Direct._nav_menu_2')
@endsection
