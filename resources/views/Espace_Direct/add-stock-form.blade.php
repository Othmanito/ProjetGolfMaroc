@extends('layouts.main_master')

@section('title') Ajout Stock @endsection

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
		<h1 class="page-header">Ajouter au Stock <small> </small></h1>

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
					<form role="form" method="post" action="{{ Route('direct.submitAdd',['param' => 'stock']) }}">
						{{ csrf_field() }}


						<!-- Row 1 -->
						<div class="row">

							<div class="col-lg-3">
								{{-- Magasin --}}
								<div class="form-group">
									<label>Magasin</label>
									<select class="form-control" name="id_magasin" autofocus>
									@if( !$magasins->isEmpty() )
										@foreach( $magasins as $item )
											<option value="{{ $item->id_magasin }}" {{ $item->id_magasin == old('id_magasin') ? 'selected' : '' }} > {{ $item->libelle }} () </option>
										@endforeach
									@endif
								</select>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Article --}}
								<div class="form-group">
									<label>Article</label>
									<select class="form-control" name="id_article">
										@if( !$articles->isEmpty() )
											@foreach( $articles as $item )
												<option value="{{ $item->id_article }}" {{ $item->id_article == old('id_article') ? 'selected' : '' }} > {{ $item->designation_c }}</option>
											@endforeach
										@endif
								</select>
								</div>
							</div>

						</div>
						<!-- end row 1 -->

						<!-- Row 2 -->
						<div class="row">

							<div class="col-lg-3">
								{{-- Quantite --}}
								<div class="form-group">
									<label>Quantite</label>
									<input type="number" min="0" class="form-control"  placeholder="Quantite" name="quantite" value="{{ old('quantite') }}" required>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Quantite_min --}}
								<div class="form-group">
									<label>Quantite minimum</label>
									<input type="number" min="0" class="form-control"  placeholder="Quantite Min" name="quantite_min" value="{{ old('quantite_min') }}" required>
								</div>
							</div>

							<div class="col-lg-3">
								{{-- Quantite_max --}}
								<div class="form-group">
									<label>Quantite maximum</label>
									<input type="number" min="0" class="form-control"  placeholder="Quantite Max" name="quantite_max" value="{{ old('quantite_max') }}" required>
								</div>
							</div>


						</div>
						<!-- end row 2 -->


						<!-- row 4 -->
						<div class="row">

							<div class="col-lg-4"></div>
							<div>
								{{-- Submit & Reset --}}
								<button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button>
								<button type="submit" name="submit" value="verifier" class="btn btn-default">Vérifier</button>
								<button type="reset" class="btn btn-default">Effacer</button>
							</div>

						</div>
						<!-- end row 4 -->

						{{-- verifier si data exist et non vide --}}
						@if( isset($data) && !$data->isEmpty())
						<hr>
						<!-- row 5 -->
						<div class="row">
							<div class="col-lg-3"></div>

							<div class="col-lg-6" align="center">
								<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo10" title="Cliquez ici pour visualiser la liste des articles existants">Liste des Articles</button>
								<div id="demo10" class="collapse">
									<br>
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title" align="center">Articles <span class="badge">{{ App\Models\Article::count() }}</span></h3>
										</div>
										<div class="panel-body">
											<ul class="list-group" align="center">
												@foreach($data as $item)
													<li class="list-group-item"><a href="{{ route('direct.info',[ 'p_table' => 'articles' , 'p_id' => $item->id_article ]) }}" title="detail sur l'article">{{ $item->num_article }}: {{ $item->designation_c }}</a></li>
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
