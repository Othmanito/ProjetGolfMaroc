@extends('layouts.main_master')

@section('title') Magasin: {{ $data->libelle }} @endsection

@section('styles')
<link href="{{  asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{  asset('css/sb-admin.css') }}" rel="stylesheet">
<link href="{{  asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<script src="{{  asset('js/jquery.js') }}"></script>
<script src="{{  asset('js/bootstrap.js') }}"></script>

<script src="{{  asset('table/jquery.dataTables.js') }}"></script>
<script src="{{  asset('table/dataTables.bootstrap.js') }}"></script>
<script>
$(document).ready(function(){
		$('[data-toggle="popover"]').popover();
});
</script>
@endsection

@section('main_content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Magasin </h1>

		<div id="page-wrapper">

			{{-- Debut Alerts --}}
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">

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
				</div>
				<div class="col-lg-2"></div>
			</div>
			{{-- Fin Alerts --}}

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
									<td>Ville</td>
									<td><strong>{{ $data->ville }} </strong></td>
								</tr>
								<tr>
									<td>Nom du representant</td>
									<td><strong>{!! $data->agent or '<i></i>' !!} </strong></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><strong>{{ $data->email }} </strong></td>
								</tr>
								<tr>
									<td>Telephone</td>
									<td><strong>{{ $data->telephone }} </strong></td>
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
								<a href="{{ Route('direct.delete',['p_table' => 'magasins', 'p_id' => $data->id_magasin ]) }}" onclick="return confirm('Êtes-vous sure de vouloir effacer le magasin: {{ $data->libelle }} ?')" type="button" class="btn btn-outline btn-danger"
                  title="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Supprimer le magasin et vider son stock" >Supprimer </a>
								<a href="{{ Route('direct.update',['id_article' => $data->id_magasin, 'p_table' => 'magasins' ]) }}" type="button" class="btn btn-outline btn-info"
									title="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Modifier les informations du magasin" > Modifier </a>

							</div>

						</div>
						<!-- fin panel body -->

					</div>
					<!-- fin panel -->

				</div>

				<div class="col-lg-1"></div>

			</div>
			<!-- /.container-fluid -->

			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">

					<div class="panel panel-default">
						<!-- Default panel contents -->
						<div class="panel-heading">Stock du Magasin</div>
						<div class="panel-body">
							<p>le tableau suivant montre, en detail, le stock de ce magasin</p>
						</div>

						{{-- Table de: Stock --}}
						<div class="table-responsive">

							{{-- Table --}}
		          <div class="col-lg-12">
								<table class="table table-bordered table-hover table-striped" id="dataTables-example">

								<thead>
									<tr><th width="2%"> # </th><th> Article </th><th width="15%">Quantite</th><th width="50%">Etat</th></tr>
								</thead>

								<tbody>
									@if ( isset( $stocks ) )
										@if( $stocks->isEmpty() )
											<tr><td colspan="4">le stock de ce magasin est vide, appuyez sur le bouton en bas de la page pour lui ajouter des articles</td></tr>
										@else

										{{-- boucle sur les elements du stock --}}
										@foreach( $stocks as $item )

										{{-- Tests pour definir la couleur de la ligne --}}
										@if( $item->quantite > $item->quantite_min )
										<tr class="success">
										@endif
										@if( $item->quantite < $item->quantite_min )
										<tr class="danger">
										@endif
										@if( $item->quantite == $item->quantite_min )
										<tr class="warning">
										@endif
										{{-- fin Tests pour definir la couleur de la ligne --}}

										<td>{{ $loop->index+1 }}</td>
										<td>{{ getChamp("articles", "id_article",  $item->id_article , "designation_c") }}</td>
										<!--td>{{ $item->quantite_min }} | {{ $item->quantite }} | {{ $item->quantite_max }}</td-->

										<td> {{ $item->quantite }} unités ({{ ($item->quantite / $item->quantite_max)*100 }}%) </td>

										<td>
											<div class="progress">
												<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: {{ 100*($item->quantite_min/$item->quantite_max) }}%"></div>
												<div class="progress-bar progress-bar-success progress-bar-striped" style="width: {{ 100*($item->quantite/$item->quantite_max) }}%"></div>
											</div>
										</td>
										<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{ $loop->index+1 }}">Detail</button></td>

										{{-- Modal (pour afficher les details de chaque article) --}}
										<div class="modal fade" id="myModal{{ $loop->index+1 }}" role="dialog">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">{{ getChamp("articles", "id_article",  $item->id_article , "designation_c")  }}</h4>
														</div>
														<div class="modal-body">
															<p><b>Quantité </b> {{ $item->quantite }} </p>
															<p><b>Quantité Min</b> {{ $item->quantite_min }} </p>
															<p><b>Quantité Max</b> {{ $item->quantite_max }} </p>
															<hr>
															<p><b>numero</b> {{ getChamp("articles", "id_article",  $item->id_article , "num_article")  }}</p>
															<p><b>code a barres</b> {{ getChamp("articles", "id_article",  $item->id_article , "code_barre")  }}</p>
															<p><b>Taille</b> {{ getChamp("articles", "id_article",  $item->id_article , "taille")  }}</p>
															<p><b>Couleur</b> {{ getChamp("articles", "id_article",  $item->id_article , "couleur")  }}</p>
															<p><b>sexe</b> {{ getSexeName(getChamp("articles", "id_article",  $item->id_article , "sexe") ) }}</p>
															<p><b>Prix d'achat</b> {{ getChamp("articles", "id_article",  $item->id_article , "prix_achat")  }}</p>
															<p><b>Prix de vente</b> {{ getChamp("articles", "id_article",  $item->id_article , "prix_vente")  }}</p>
															<p>{{ getChamp("articles", "id_article",  $item->id_article , "designation_l")  }}</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
														</div>
													</div>
												</div>
											</div>
										{{-- fin Modal (pour afficher les details de chaque article) --}}

									</tr>

									@endforeach
									{{-- fin boucle sur les elements du stock --}}
									@endif
									@endif


								</tbody>
							 </table>
						 </div>
						</div>
						 {{-- Fin Table de: Stock --}}

						 <div calss="row" align="center">
							 <a href="{{ Route('direct.addStock',['p_id_magasin' => $data->id_magasin ]) }}" type="button" class="btn btn-outline btn-info"
							 title="" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Ajouter des articles au stock de ce magasin"> Remplir le Stock </a>
						 </div>

					</div>
				</div>
			</div>

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
