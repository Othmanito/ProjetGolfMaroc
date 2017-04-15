@extends('layouts.main_master')

@section('title') modifier: {{ $data->nom }} {{ $data->prenom }}@endsection

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
		<h1 class="page-header">Modifier l'Utilisateur <small> </small></h1>

		<div id="page-wrapper">

			<div class="container-fluid">

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

					{{-- *************** formulaire ***************** --}}
					<form role="form" method="post" action="{{ Route('admin.submitUpdate',['p_table'=> 'users']) }}">
						{{ csrf_field() }}

						<input type="hidden" class="form-control" name="id_user" value="{{ $data->id_user }}" >


						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-2">
								{{-- Role --}}
								<div class="form-group">
									<label>Role</label>
									<select class="form-control" name="id_role">
									@if( !$roles->isEmpty() )
										@foreach( $roles as $item )
											<option value="{{ $item->id_role }}" @if( $item->id_role == $data->id_role ) selected @endif >{{ $item->libelle }}</option>
										@endforeach
									@endif
								</select>
								</div>
							</div>

							<div class="col-lg-4">
								{{-- Magasin --}}
								<div class="form-group">
									<label>Magasin</label>
									<select class="form-control" name="id_magasin">
									<option value="0" selected>Aucun</option>
									@if( !$magasins->isEmpty() )
										@foreach( $magasins as $item )
											<option value="{{ $item->id_magasin }}" @if( $item->id_magasin == $data->id_magasin ) selected @endif >{{ $item->libelle }} a {{ $item->ville }}</option>
										@endforeach
									@endif
								</select>
								</div>
							</div>

							<div class="col-lg-4">
								{{-- Email --}}
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" placeholder="E-mail" name="email" value="{{ $data->email }}" required>
									<p class="help-block">utilisé pour l'authentification</p>
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- row 2 -->
						<div class="row">

							<div class="col-lg-3">
								{{-- nom --}}
								<div class="form-group">
									<label>Nom</label>
									<input type="text" class="form-control" placeholder="Nom" name="nom" value="{{ $data->nom }}" required>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Prenom --}}
								<div class="form-group">
									<label>Prenom</label>
									<input type="text" class="form-control" placeholder="Prenom" id="prenom" value="{{ $data->prenom }}">
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Ville --}}
								<div class="form-group">
									<label>Ville</label>
									<input type="text" class="form-control" placeholder="Ville" name="ville" value="{{ $data->ville }}">
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Telephone --}}
								<div class="form-group">
									<label>Telephone</label>
									<input type="number" class="form-control" placeholder="Telephone" name="telephone" value="{{ $data->telephone }}">
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-6">
								{{-- Description --}}
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="5" placeholder="Description" name="description" >{{ $data->description }}</textarea>
								</div>
							</div>

							<div class="col-lg-6">
								<br/><br/>
								{{-- Submit & Reset --}}
								<button type="submit" name="submit" value="valider" class="btn btn-default" width="60">Valider</button>
								<button type="reset" value="" class="btn btn-default">Réinitialiser</button>
							</div>

						</div>

					</form>

					{{-- erreur (not used) --}}
					@if( isset($error) )
					<div class="col-lg-12">
						<div class="alert alert-danger">
							<strong>Oh snap!</strong> {{ $error }}
						</div>
					</div>
					@endif

			</div>
			<!-- /#page-wrapper -->
		</div>
	</div>
</div>
	<!-- /.row -->
@endsection


@section('menu_1')
	@include('Espace_Admin._nav_menu_1')
@endsection

@section('menu_2')
	@include('Espace_Admin._nav_menu_2')
@endsection
