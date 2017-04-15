@extends('layouts.main_master')

@section('title') Modification Article @endsection

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
		<h1 class="page-header">Modifier un Article <small> </small></h1>

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
					<form role="form" method="post" action="{{ Route('direct.submitUpdate',[ 'p_table' => 'articles' ]) }}">
						{{ csrf_field() }}

						<input type="hidden" class="form-control" name="id_article" value="{{ $data->id_article }}" >


						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-3">
								{{-- Categorie --}}
								<div class="form-group">
									<label>Categorie</label>
									<select class="form-control" name="id_categorie" autofocus>
										@if( $categories!=null )
										@foreach( $categories as $item )
											<option value="{{ $item->id_categorie }}" {{ $item->id_categorie == $data->id_categorie ? 'selected' : '' }}>{{ $item->libelle }}</option>
										@endforeach
										@else
											<option value="0" >aucune categorie</option>
										@endif
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Fournisseur --}}
								<div class="form-group">
									<label>Fournisseur</label>
									<select class="form-control" name="id_fournisseur">
										@if( $fournisseurs!=null )
										@foreach( $fournisseurs as $item )
											<option value="{{ $item->id_fournisseur }}" {{ $item->id_fournisseur == $data->id_fournisseur ? 'selected' : '' }}>{{ $item->libelle }}</option>
										@endforeach
										@else
											<option value="0" >aucune categorie</option>
										@endif
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- num_article --}}
								<div class="form-group">
									<label>Numero de l'article</label>
									<input type="text" class="form-control" placeholder="Numero Article" name="num_article" value="{{  $data->num_article or old('num_article') }}" required>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- code_barre --}}
								<div class="form-group">
									<label>Code a Barres</label>
									<input type="text" class="form-control" placeholder="Code a Barres" name="code_barre" value="{{ $data->code_barre or old('code_barre') }}" required>
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- Row 2 -->
						<div class="row">

							<div class="col-lg-6">
								{{-- Designation_c --}}
								<div class="form-group">
									<label>Designation Courte</label>
									<input type="text" class="form-control"  placeholder="Designation Courte" name="designation_c" value="{{ $data->designation_c or old('designation_c') }}" required>
								</div>
							</div>

							<div class="col-lg-6">
								{{-- Designation_l --}}
								<div class="form-group">
									<label>Description</label>
									<textarea type="text" class="form-control" rows="2" placeholder="Designation Longue" name="designation_l">{{ $data->designation_l or old('designation_l') }}</textarea>
								</div>
							</div>

						</div>
						<!-- end row 2 -->

						<!-- row 3 -->
						<div class="row">

							<div class="col-lg-3">
								{{-- Taille --}}
								<div class="form-group">
									<label>Taille</label>
									<input type="text" class="form-control" placeholder="Taille" name="taille" value="{{ $data->taille or old('taille') }}">
								</div>
							</div>

							<div class="col-lg-2">
								{{-- Sexe --}}
								<div class="form-group">
									<label>Sexe</label>
									<select class="form-control" name="sexe">
										<option value="aucun" {{ $data->sexe == "aucun" ? 'selected' : '' }}>Aucun</option>
										<option value="h" {{ $data->sexe == "h" ? 'selected' : '' }}>Homme</option>
										<option value="f" {{ $data->sexe == "f" ? 'selected' : '' }}>Femme</option>
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Couleur --}}
								<div class="form-group">
									<label>Couleur</label>
									<input type="text"  class="form-control" placeholder="Couleur" name="couleur" value="{{ $data->couleur }}">
								</div>
							</div>

							<div class="col-lg-2">
								{{-- Prix achat --}}
								<div class="form-group">
									<label>Prix d'achat</label>
									<input type="number" step="0.01" pattern=".##" min="0" class="form-control" placeholder="Prix d'achat" name="prix" value="{{ $data->prix_achat }}">
								</div>
							</div>

							<div class="col-lg-2">
								{{-- Prix vente --}}
								<div class="form-group">
									<label>Prix (HT)</label>
									<input type="number" step="0.01" pattern=".##" min="0" class="form-control" placeholder="Prix de Vente" name="prix" value="{{ $data->prix_vente }}">
								</div>
							</div>

						</div>
						<!-- end row 3 -->

						<!-- row 4 -->
						<div class="row">

							<div class="col-lg-4"></div>
							<div>
								{{-- Submit & Reset --}}
								<button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
								<button type="submit" name="submit" value="verifier" class="btn btn-default" disabled>Vérifier</button>
								<button type="reset" class="btn btn-default">Effacer</button>
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
