@extends('layouts.main_master') @section('title') Categories @endsection @section('styles')
<link href="{{  asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{  asset('css/sb-admin.css') }}" rel="stylesheet">
<link href="{{  asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"> @endsection @section('scripts')
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
@endsection @section('main_content')
<div class="container-fluid">
    <!-- main row -->
    <div class="row">

        <h1 class="page-header">Liste des Categories <small> </small></h1>

        <!-- row -->
        <div class="row">

            {{-- **************Alerts************** --}}
            <div class="row">
                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    {{-- Debut Alerts --}} @if (session('alert_success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_success') !!}
                    </div>
                    @endif @if (session('alert_info'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_info') !!}
                    </div>
                    @endif @if (session('alert_warning'))
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_warning') !!}
                    </div>
                    @endif @if (session('alert_danger'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> {!! session('alert_danger') !!}
                    </div>
                    @endif {{-- Fin Alerts --}}
                </div>

                <div class="col-lg-2"></div>
            </div>
            {{-- **************endAlerts************** --}}

            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover table-striped" id="dataTables-example">

                            <thead>
                                <tr>
                                    <th width="2%"> # </th>
                                    <th width="25%"> Categorie </th>
                                    <th>Description</th>
                                    <th width="10%">Autres</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ( isset( $data ) )
                                  @if( $data->isEmpty() )
                                    <tr><td colspan="4" align="center">Aucune Marque</td></tr>
                                  @else
                                    @foreach( $data as $item )
                                      <tr class="odd gradeA">
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->libelle }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                          <a href="{{ Route('direct.info',['p-table'=> 'categories', 'p_id'=> $item->id_categorie ]) }}" title="info sur la categorie"><i class="glyphicon glyphicon-eye-open"></i></a>
                                          <a href="{{ Route('direct.updateForm',['p-table'=> 'categories', 'p_id'=> $item->id_categorie ]) }}" title="modifier la categorie"><i class="glyphicon glyphicon-pencil"></i></a>
                                          <a onclick="return confirm('Êtes-vous sure de vouloir effacer la Categorie: {{ $item->libelle }} ?')" href="{{ Route('direct.delete',['p_table' => 'categories' , 'p_id' => $item->id_categorie ]) }}" title="effacer la categorie"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                      </tr>
                                    @endforeach
                                  @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>

        </div>
        <!-- row -->


        <!-- row -->
        <div class="row" align="center">
            <a type="button" class="btn btn-outline btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true">  Imprimer </i></a>
            <a href="{{ Route('direct.add',[ 'p_table' => 'categories' ]) }}" type="button" class="btn btn-outline btn-default">  Ajouter une Categorie</a>
        </div>
        <!-- row -->

    </div>
    <!-- end main row -->

</div>
@endsection @section('menu_1') @include('Espace_Direct._nav_menu_1') @endsection @section('menu_2') @include('Espace_Direct._nav_menu_2') @endsection
