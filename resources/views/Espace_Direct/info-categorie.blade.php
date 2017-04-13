@extends('layouts.main_master')

@section('title') Categorie: {{ $data->libelle }} @endsection

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
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Categorie<small> </small></h1>

		<div id="page-wrapper">

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

			<div class="container-fluid">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">

					<!-- debut panel -->
					<div class="panel panel-default">
						<div class="panel-heading" align="center">
							<h2>{{ $data->libelle }}</h2>
						</div>

						<!-- debut panel body -->
						<div class="panel-body">
							<table class="table table-hover" border="0" cellspacing="0" cellpadding="5">

								<tr>
									<td>Libelle</td>
									<td><strong>{{ $data->libelle }} </strong></td>
								</tr>
								<tr>
									<td>Date de creation</td>
									<td><strong>{{ getDateHelper($data->created_at) }} a {{ getTimeHelper($data->created_at) }}    </strong></td>
								</tr>
								<tr>
									<td>Date de derniere modification</td>
									<td><strong>{{ getDateHelper($data->updated_at) }} a {{ getTimeHelper($data->updated_at) }}     </strong></td>
								</tr>

								<tr></tr>

								<tr>
									<td>nombre d'articles dans la catégorie</td>
									<td><strong>{{ App\Models\Article::whereIdCategorie($data->id_categorie)->count() }} </strong></td>
								</tr>

							</table>


							@if( strlen($data->description) > 0 )
							<div class="page-header">
								<h3>Description</h3>
							</div>
							<div class="well">
								<p>{{ $data->description }}</p>
							</div>
							@endif

							<div class="col-lg-4"></div>
							<div class="col-lg-4">
								<a href="{{ Route('direct.delete',['p_table' => 'categories', 'p_id' => $data->id_categorie ]) }}" onclick="return confirm('Êtes-vous sure de vouloir effacer la categorie: {{ $data->libelle }} ?')" type="button" class="btn btn-outline btn-danger">Supprimer </a>
								<a href="{{ Route('direct.updateForm',['p_table' => 'categories', 'p_id' => $data->id_categorie ]) }}" type="button" class="btn btn-outline btn-info"> Modifier </a>

							</div>

						</div>
						<!-- fin panel body -->

					</div>
					<!-- fin panel -->

				</div>

				<div class="col-lg-1"></div>

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->
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
