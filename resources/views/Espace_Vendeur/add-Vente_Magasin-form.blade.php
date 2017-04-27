@extends('layouts.main_master')

@section('title') Ajouter une vente   @endsection

@section('styles')
<link href="{{  asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{  asset('css/sb-admin.css') }}" rel="stylesheet">
<link href="{{  asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<script src="{{  asset('table2/datatables.min.js') }}"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" size="10" class="form-control" placeholder="Rechercher par ' + title + '" />');
        });
        // DataTable
        var table = $('#example').DataTable();
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
@endsection

@section('main_content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ajouter une vente <small> </small></h1>

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
                  <form role="form" method="post" action="{{ Route('vendeur.submitAddVente') }}">
                    <div class="row">
                      <div class="col-lg-2">

                      <div class="form-group">


                                                    </div></div>

                    <div class="col-lg-5">

                    <div class="form-group">

                                                    <label>Mode de Paiement</label>

                                                    <select class="form-control" name="mode">
                                                      @foreach( $mode as $mo )

                                                        <option value="{{$mo->id_mode }}">{{$mo->libelle }}</option>
                                                          @endforeach
                                                    </select>

                                                </div></div>

                                          <div class="col-lg-5">
                                              @foreach( $mode as $mo )
                                            @if($mo->id_mode==1)
                                            <label>Reference chequier</label>
                                            <input class="form-control" type="text" min="0" placeholder="Refchequier" name="ref" ></input>

                                            @endif
                                          @endforeach

                              </div>




                    {{ csrf_field() }}



								 <table class="table table-striped table-bordered table-hover" id="example">
									 <thead bgcolor="#DBDAD8">
										 <tr><th width="2%"> # </th><th width="25%"></th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Prix de vente</th><th>Quantite en stock</th><th>Quantité vendue</th><th width="10%">Autres</th></tr>
									 </thead>
									 <tfoot bgcolor="#DBDAD8">
										 <tr><th width="2%"> # </th><th width="25%"></th><th width="25%">Article</th><th>Categorie</th><th>Fournisseur</th><th>Prix de vente</th><th>Quantité en stock</th><th>Quantité vendue</th><th width="10%">Autres</th></tr>
									 </tfoot>

									 <tbody>
										 @if ( isset( $articles ) )
										 @if( $articles->isEmpty() )
										 <tr><td colspan="5" align="center">Aucun Article</td></tr>
										 @else
										 @foreach( $articles as $item )


										 <tr class="odd gradeA">
                       <input type="hidden" name="id_article[{{ $loop->index+1 }}]" value="{{ $item->id_article }}" >
                       <input type="hidden" name="designation_c[{{ $loop->index+1 }}]" value="{{ getChamp('articles', 'id_article', $item->id_article , 'designation_c')  }}" />
                       <input type="hidden" name="id_transaction[{{ $loop->index+1 }}]" value="{{ getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_transaction')  }}" />
                       <input type="hidden" name="id_magasin" value="{{ $item->id_magasin }}" >
                       <input type="hidden" name="id_user" value="{{ getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_user')  }}" >
                       <input type="hidden" name="id_typeTrans" value="{{ getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_typeTrans')  }}" >
                       <input type="hidden" name="id_paiement" value="{{ getChamp('transactions', 'id_magasin', $item->id_magasin , 'id_paiement')  }}" >
                       <input type="hidden" name="quantiteV" value="{{ $item->quantite }}" >

											 <td align="right">{{ $loop->index+1 }}</td>
                        <td>{{ getChamp('articles', 'id_article', $item->id_article , 'image') }}</td>
                       <td>{{ getChamp('articles', 'id_article', $item->id_article , 'designation_c') }}</td>
                       <td>{{ getChamp('categories', 'id_categorie', getChamp('articles', 'id_article', $item->id_article, 'id_categorie') , 'libelle') }}</td>
                       <td>{{ getChamp('fournisseurs', 'id_fournisseur', getChamp('articles', 'id_article', $item->id_article, 'id_fournisseur') , 'libelle') }}</td>
                       <td align="right">{{ number_format(getChamp('articles', 'id_article', $item->id_article , 'prix_vente'),2,',','') }} DH</td>

                       <td align="right">{{ $item->quantite }}</td>
											 <td><input type="number" min="0" placeholder="Quantite" name="quantite[{{ $loop->index+1 }}]"  max="{{ $item->quantite }}" ></td>
											 <td>
													 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal{{ $loop->index+1 }}">Detail Article</button>
											 </td>
											 {{-- Modal (pour afficher les details de chaque article) --}}
											 <div class="modal fade" id="myModal{{ $loop->index+1 }}" role="dialog">
												 <div class="modal-dialog modal-sm">
													 <div class="modal-content">
														 <div class="modal-header">
															 <button type="button" class="close" data-dismiss="modal">&times;</button>
															 <h4 class="modal-title">{{ getChamp('articles', 'id_article', $item->id_article , 'designation_c') }}</h4>
														 </div>
														 <div class="modal-body">
															 <p><b>numero</b> {{ getChamp('articles', 'id_article', $item->id_article , 'num_article') }}</p>
															 <p><b>code a barres</b> {{ getChamp('articles', 'id_article', $item->id_article , 'code_barre') }}</p>
															 <p><b>Taille</b> {{ getChamp('articles', 'id_article', $item->id_article , 'taille') }}</p>
															 <p><b>Couleur</b> {{ getChamp('articles', 'id_article', $item->id_article , 'couleur') }}</p>
															 <p><b>sexe</b> {{ getSexeName(getChamp('articles', 'id_article', $item->id_article , 'sexe')) }}</p>
															 <p><b>Prix d'achat</b> {{ getChamp('articles', 'id_article', $item->id_article , 'prix_achat') }}</p>
															 <p><b>Prix de vente</b> {{ getChamp('articles', 'id_article', $item->id_article , 'prix_vente') }}</p>

															 <p>{{ getChamp('articles', 'id_article', $item->id_article , 'designation_l') }}</p>

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
										 @endif
										 @endif

									 </tbody>



								 </table>
								<center><button type="submit" name="submit" value="valider" class="btn btn-primary">Valider la vente</button></center>

</form>

							 </div>
							</div>

						</div>
						<!-- end row 1 -->


<!--
						{{-- verifier si data exist et non vide --}}
						@if( isset($data) && !$data->isEmpty())
						<hr>

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
						<!-- end row 5
						@endif
						{{-- fin if --}}
					-->


			</div>
			<!-- /#page-wrapper -->
		</div>
	</div>
</div>
	<!-- /.row -->
@endsection


@section('menu_1')
	@include('Espace_Vendeur._nav_menu_1')
@endsection

@section('menu_2')
	@include('Espace_Vendeur._nav_menu_2')
@endsection
