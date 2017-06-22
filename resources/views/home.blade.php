@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <!--@include('partials/errors')-->
            @include('partials/succes')
            <div class="panel panel-default">
                <div class="panel-heading">@lang('auth.home_title')</div>
                <div class="panel-body">
                    <h1>Sistema para el Arriendo de Carros para Niños</h1>
                    You are using bootstrap
                </div>
            </div>
        </div>
    </div>
</div>
@endsection