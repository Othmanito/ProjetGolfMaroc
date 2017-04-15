@extends('layouts.main_master')

@section('title') Charts @endsection

@section('styles')
<link href="{{  asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{  asset('css/sb-admin.css') }}" rel="stylesheet">
<link href="{{  asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
{{!! Charts::assets() !!}}
@endsection

@section('scripts')
<script src="{{  asset('js/jquery.js') }}"></script>
<script src="{{  asset('js/bootstrap.js') }}"></script>
@endsection

@section('main_content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-5">


        {!! $chart->render() !!}


    </div>

        <div class="col-lg-5">


            {!! $chart2->render() !!}


        </div>
</div>

<div class="row">
    <div class="col-lg-5">


        {!! $chart3->render() !!}


    </div>

        <div class="col-lg-5">


            {!! $chart4->render() !!}


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
