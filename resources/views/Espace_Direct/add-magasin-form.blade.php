@extends('layouts.main_master')

@section('title') Ajout Magasin @endsection

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
		<h1 class="page-header">Ajouter un Magasin <small> </small></h1>

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
					<form role="form" method="post" action="{{ Route('direct.submitAdd',['p_table' => 'magasins']) }}">
						{{ csrf_field() }}


						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-8">
								{{-- Libelle --}}
								<div class="form-group">
									<label>Nom du magasin</label>
									<input type="text" class="form-control" placeholder="Nom du magasin" name="libelle" value="{{ old('libelle') }}" required autofocus>
								</div>
							</div>

							<div class="col-lg-4">
								{{-- Ville --}}
								<div class="form-group">
									<label>Ville</label>
									<input type="text" class="form-control" placeholder="Ville" name="ville" value="{{ old('ville') }}">
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- Row 2 -->
						<div class="row">

							<div class="col-lg-4">
								{{-- Agent --}}
								<div class="form-group">
									<label>Nom du representant</label>
									<input type="text" class="form-control" placeholder="Agent" name="agent" value="{{ old('agent') }}">
								</div>
							</div>

							<div class="col-lg-4">
								{{-- Telephone --}}
								<div class="form-group">
									<label>Telephone</label>
									<input type="text" class="form-control" placeholder="Telephone" name="telephone" value="{{ old('telephone') }}">
								</div>
							</div>

							<div class="col-lg-4">
								{{-- Libelle --}}
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-6">
								{{-- Adresse --}}
								<div class="form-group">
									<label>Adresse</label>
									<textarea type="text" class="form-control" rows="2" placeholder="Adresse" name="adresse">{{ old('adresse') }}</textarea>
								</div>
							</div>

							<div class="col-lg-6">
								{{-- Description --}}
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="5" placeholder="Description" name="description">{{ old('description') }}</textarea>
								</div>
							</div>

						</div>
						<!-- end row 3 -->

						<!-- row 4 -->
						<div class="row" align="center">
								{{-- Submit & Reset --}}
								<label title="aa">cochez pour forcer l'ajout de l'article</label>
								<input type="checkbox" name="force" value="true"><br>
								<button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
								<button type="reset" class="btn btn-default">Effacer</button>
						</div>
						<!-- end row 4 -->

						{{-- verifier si data exist et non vide --}}
						@if( isset($data) && !$data->isEmpty())
						<hr>
						<!-- row 5 -->
						<div class="row">
							<div class="col-lg-3"></div>

							<div class="col-lg-6" align="center">
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo10" title="Cliquez ici pour visualiser la liste des Magasins existants">Liste des Magasins</button>
								<div id="demo10" class="collapse">
									<br>
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title" align="center">Magasins <span class="badge">{{ App\Models\Magasin::count() }}</span></h3>
										</div>
										<div class="panel-body">
											<ul class="list-group" align="center">
												@foreach($data as $item)
													<li class="list-group-item"><a href="{{ route('direct.info',[ 'p_table' => 'magasins' , 'p_id' => $item->id_magasin ]) }}" title="detail sur le magasin"> {{ $item->libelle }}</a></li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-3"></div>
						</div>
						<!-- end row 5 -->
						@endif
						{{-- fin if --}}

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
