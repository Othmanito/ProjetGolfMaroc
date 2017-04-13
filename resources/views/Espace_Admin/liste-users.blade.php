@extends('layouts.main_master')

@section('title') Utlisateurs @endsection

@section('styles')
<link href="{{  asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{  asset('css/sb-admin.css') }}" rel="stylesheet">
<link href="{{  asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<script src="{{  asset('js/jquery.js') }}"></script>
<script src="{{  asset('js/bootstrap.js') }}"></script>

<script src="{{  asset('table/jquery.js') }}"></script>
<script src="{{  asset('table/jquery.dataTables.js') }}"></script>
<script src="{{  asset('table/dataTables.bootstrap.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
@endsection

@section('main_content')
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Liste des Employes <small> </small></h1>

		<div id="page-wrapper">

			<div class="container-fluid">

        {{-- div Table --}}
				<div class="table-responsive">
          {{-- Table --}}
          <div class="col-lg-12">
					<table class="table table-bordered table-hover table-striped" id="dataTables-example" >
						<thead>
							<tr>
								<th width="4%">#</th>
								<th width="6%">Role</th>
								<th>Nom</th>
								<th>Prenom</th>
								<th>Ville</th>
								<th>Email</th>
								<th width="10%">Magasin</a></th>
								<th>Autres</a></th>
							</tr>
						</thead>

						<tbody>
							@if ( isset( $data ) )
							@if( $data->isEmpty() )
							<tr>
								<td colspan="7">Aucun employe</td>
							</tr>
							@else
							@foreach( $data as $item )
							<tr class="odd gradeA">
								<td>{{ $loop->index+1 }}</td>
								<td>{{ getRoleName( $item->id_role ) }}</td>
								<td>{{ $item->nom }}</td>
								<td>{{ $item->prenom }}</td>
								<td>{{ $item->ville }}</td>
								<td>{{ $item->email }}</td>
								<td><a href=""> {!! getMagasinName( $item->id_magasin )!=null ? getMagasinName( $item->id_magasin ) : '<i>Aucun</i>'   !!}</a></td>
								<td>
									<a href="{{ Route('admin.infoUser',['id'=> $item->id_user]) }}" title="Detail"><i class="glyphicon glyphicon-user"></i></a>
									<a href="{{ Route('admin.updateUser',['id' => $item->id_user ]) }}" title="Modifier"><i class="glyphicon glyphicon-pencil"></i></a>
									<a onclick="return confirm('Êtes-vous sure de vouloir effacer l\'utilisateur: {{ $item->nom }} {{ $item->prenom }} ?')" href="{{ Route('admin.deleteUser',['id' => $item->id_user ]) }}" title="Supprimer"><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
							@endforeach
							@endif
							@endif
						</tbody>

					</table>
          <div>
          {{-- end Table --}}

				</div>
        {{-- end div Table --}}

        </div>
			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->
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
