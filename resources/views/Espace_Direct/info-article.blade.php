@extends('layouts.main_master')

@section('title') Article: {{ $data->designation_c }} @endsection

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
		<h1 class="page-header">Article </h1>

		<div id="page-wrapper">

			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
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
			</div>
			<div class="col-lg-2"></div>
			</div>

			<div class="container-fluid">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">

					<!-- debut panel -->
					<div class="panel panel-default">
						<div class="panel-heading" align="center">
							<h2>{{ $data->designation_c }}</h2>
						</div>
						<!-- debut panel body -->
						<div class="panel-body">
							<table class="table table-hover" border="0" cellspacing="0" cellpadding="5">
								<tr>
									<td>Numero de l'article</td>
									<td><strong>{{ $data->num_article }} </strong></td>
								</tr>
								<tr>
									<td>Code a Barres</td>
									<td><strong>{{ $data->code_barre }} </strong></td>
								</tr>
								<tr>
									<td>Designation Courte</td>
									<td><strong>{{ $data->designation_c }} </strong></td>
								</tr>
								<tr>
									<td>Taille</td>
									<td><strong>{{ $data->taille }} </strong></td>
								</tr>
								<tr>
									<td>Couleur</td>
									<td><strong>{{ $data->couleur }} </strong></td>
								</tr>
								<tr>
									<td>Sexe</td>
									<td><strong>{{ getSexeName($data->sexe) }} </strong></td>
								</tr>
								<tr>
									<td>Prix d'achat</td>
									<td><strong>{{ $data->prix_achat }} </strong></td>
								</tr>
								<tr>
									<td>Prix de vente</td>
									<td><strong>{{ $data->prix_vente }} </strong></td>
								</tr>
								<tr>
									<td>Date de creation</td>
									<td><strong>{{ getDateHelper($data->created_at) }} a {{ getTimeHelper($data->created_at) }}    </strong></td>
								</tr>
								<tr>
									<td>Date de derniere modification</td>
									<td><strong>{{ getDateHelper($data->updated_at) }} a {{ getTimeHelper($data->updated_at) }}     </strong></td>
								</tr>
							</table>


							@if( strlen($data->designation_l) > 0 )
							<div class="page-header">
								<h3>Designation Longue</h3>
							</div>
							<div class="well">
								<p>{{ $data->designation_l }}</p>
							</div>
							@endif


							<div class="row" align="center">
								<a href="{{ Route('direct.delete',['p_table' => 'articles', 'p_id' => $data->id_article ]) }}" onclick="return confirm('Êtes-vous sure de vouloir effacer l\'article: {{ $data->designation_c }} ?')" type="button" class="btn btn-outline btn-danger">Supprimer </a>
								<a href="{{ Route('direct.update',['id_article' => $data->id_article, 'p_table' => 'articles' ]) }}" type="button" class="btn btn-outline btn-info"> Modifier </a>
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
