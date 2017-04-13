@extends('layouts.main_master')

@section('title') Ajout Stock du magasin {{ $magasin->libelle }}  @endsection

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
@endsection

@section('main_content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ajouter au Stock du magasin {{ $magasin->libelle }} <small> </small></h1>

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




						<!-- Row 1 -->
						<div class="row">

							<div class="table-responsive">

								<div class="col-lg-12">



                  {{-- *************** formulaire ***************** --}}
                  <form role="form" method="post" action="{{ Route('direct.submitAdd',['param' => 'stock']) }}">
                    {{ csrf_field() }}
                    <input type="hidden"  name="id_magasin" value="{{ $magasin->id_magasin }}" />


								 <table class="table table-bordered table-hover table-striped" id="dataTables-example">

									 <thead>
										 <tr><th width="2%"> # </th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Quantite</th><th>Quantite min</th><th>Quantite max</th><th width="10%">Autres</th></tr>
									 </thead>

									 <tbody>
										 @if ( isset( $articles ) )
										 @if( $articles->isEmpty() )
										 <tr><td colspan="5" align="center">Aucun Article</td></tr>
										 @else
										 @foreach( $articles as $item )

										 <tr class="odd gradeA">
                       <input type="hidden" name="id_article[{{ $loop->index+1 }}]" value="{{ $item->id_article }}" >
											 <td>{{ $loop->index+1 }}</td>
											 <td>{{ $item->designation_c }}</td>
                       <td>{{ getChamp('categories', 'id_categorie', $item->id_categorie, 'libelle') }}</td>
                       <td>{{ getChamp('fournisseurs', 'id_fournisseur',  $item->id_fournisseur, 'libelle') }}</td>
											 <td><input type="number" min="0" placeholder="Quantite" name="quantite[{{ $loop->index+1 }}]"  ></td>
                       <td><input type="number" min="0" placeholder="Quantite Min" name="quantite_min[{{ $loop->index+1 }}]" value="{{ old('quantite_min[$loop->index+1]') }}"></td>
                       <td><input type="number" min="0" placeholder="Quantite Max" name="quantite_max[{{ $loop->index+1 }}]" value="{{ old('quantite_max[$loop->index+1]') }}"></td>
											 <td>
                         autre
                       </td>
										 </tr>

										 @endforeach
										 @endif
										 @endif

									 </tbody>

                   <tr><td colspan="8" align="center"><button type="submit" name="submit" value="valider" class="btn btn-default">Valider</button></td></tr>


								 </table>
</form>

							 </div>
							</div>

						</div>
						<!-- end row 1 -->



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
