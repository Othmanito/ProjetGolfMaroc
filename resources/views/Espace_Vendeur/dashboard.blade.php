@extends('layouts.main_master')

@section('title') Espace Vendeur @endsection

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
        <h1 class="page-header">Bienvenue dans votre Espace Vendeur </h1>
      <!--  <img width="100%" height="100%" src="images/golf.jpg"/>-->
      <div class="col-lg-3 col-md-6">
                              <div class="panel panel-yellow">
                                  <div class="panel-heading">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <i class="fa fa-shopping-cart fa-5x"></i>
                                          </div>
                                          <div class="col-xs-6 text-right">
                                              <div class="huge">{{ App\Models\Transaction::where(['id_typeTrans'=> 3,'id_user'=> 3 ])->count() }}</div>
                                              <div>Ventes</div>
                                          </div>
                                      </div>
                                  </div>
                                  <a href="{{Route('vendeur.lister',['param' => 'ventes' ]) }}">
                                      <div class="panel-footer">
                                          <span class="pull-left">Voir Details</span>
                                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                          <div class="clearfix"></div>
                                      </div>
                                  </a>
                              </div>
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
