@extends('adminlte::page')

@section('title', 'Library')

@section('content_header')
    <h1>Trainings library</h1>
@stop

@section('content')
<div class="row">

  <div class="col-md-10 col-md-offset-1">
    <div class="box">
      <div class="box-header">
        <a href="/concepts/create" class="btn btn-success btn-xs">New</a>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <tbody><tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
          </tr>

          @foreach ($concepts as $concept)
            <tr>
              <td>{{ $concept->id }}</td>
              <td>{{ $concept->title }}</td>
            </tr>
          @endforeach

        </tbody></table>
      </div>
    </div>
  </div>

</div>
@stop
