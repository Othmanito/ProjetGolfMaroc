@extends('layouts.main_master')

@section('title') Stock du magasin  @endsection

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
</script>
@endsection

@section('main_content')
<div class="container-fluid">
  <!-- main row -->
  <div class="row">
    <h1 class="page-header">Stock du magasin <strong>{{ getChamp('magasins','id_magasin',$data->first()->id_magasin, 'libelle')  }}</strong> <small> </small></h1>

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

    <div class="table-responsive">
	    <table id="example" class="table table-striped table-bordered table-hover">

        <thead bgcolor="#DBDAD8">
          <tr><th width="2%"> # </th><th> Article </th><th>Quantite</th><th width="10%">Autres</th></tr>
        </thead>
        <tfoot bgcolor="#DBDAD8">
          <tr><th id="i1" width="2%"> # </th><th> Article </th><th>Quantite</th><th width="10%">Autres</th></tr>
        </tfoot>

        <tbody>
          @if ( isset( $data ) )
          @if( $data->isEmpty() )
          <tr><td colspan="4">Aucun Magasin</td></tr>
          @else
          @foreach( $data as $item )
          <tr>
          <td>{{ $loop->index+1 }}</td>
          <td>{{ getChamp('articles','id_article',$item->id_article, 'designation_c') }}</td>
          <td {{ $item->quantite<=$item->quantite_min ? 'bgcolor="red"' : '' }}> {{ $item->quantite }}</td>
          <td>
          <a href="{{ Route('direct.info',['p_table'=> 'magasins' , 'p_id' => $item->id_magasin  ]) }}" title="detail"><i class="glyphicon glyphicon-eye-open"></i></a>
          <a href="{{ Route('direct.update',['p_table'=> 'magasins' , 'p_id' => $item->id_magasin  ]) }}" title="modifier"><i class="glyphicon glyphicon-pencil"></i></a>
          <a onclick="return confirm('Êtes-vous sure de vouloir effacer le magasin: {{ $item->libelle }} ?')" href="{{ Route('direct.delete',['p_table' => 'magasins' , 'p_id' => $item->id_magasin ]) }}" title="supprimer"><i class="glyphicon glyphicon-trash"></i></a>
          </td>
          </tr>
          @endforeach
          @endif
          @endif

        </tbody>
      </table>
      </div>



      <!-- row -->
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-8">
          <a onclick="return alert('Printing ....')" type="button" class="btn btn-outline btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true">  Imprimer </i></a>
          <a href="{{ Route('direct.addStock',[ 'p_id_magasin' => $data->first()->id_magasin ]) }}" type="button" class="btn btn-outline btn-default">  Ajouter Au Stock </a>
        </div>
      </div>
      <!-- row -->

  </div>
  <!-- end main row -->

</div>
@endsection


@section('menu_1')
	@include('Espace_Direct._nav_menu_1')
@endsection

@section('menu_2')
	@include('Espace_Direct._nav_menu_2')
@endsection
