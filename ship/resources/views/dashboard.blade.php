@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to the ship app of SWS.</p>

    <a href="/sync" class="btn btn-success">Synchronise with the office</a>
@stop
