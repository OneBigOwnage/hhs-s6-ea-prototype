@extends('adminlte::page')

@section('title', 'Ships')

@section('content_header')
    <h1>Ships</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-10 col-md-offset-1">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Trainings</h3>
          <div  class="pull-right">
            <button type="button" class="btn btn-block btn-success btn-xs">New</button>
          </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Identifier</th>
                <th style="width: 100px"># of trainings</th>
              </tr>

              @foreach ($ships as $ship)
                <tr>
                  <td>{{ $ship->id }}</td>
                  <td>{{ $ship->name }}</td>
                  <td>{{ $ship->unique_identifier }}</td>
                  <td>{{ $ship->trainings()->count() }}</td>
                </tr>
              @endforeach

            </tbody></table>
        </div>
      </div>
    </div>

  </div>
@stop
