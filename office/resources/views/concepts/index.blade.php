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
        <h3 class="box-title">Training concepts</h3>
        <div  class="pull-right">
          <button type="button" class="btn btn-block btn-success btn-xs">New</button>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <tbody><tr>
            <th style="width: 10px">#</th>
            <th>Title</th>
            <th style="width: 100px">Actions</th>
          </tr>

          @foreach ($concepts as $concept)
            <tr>
              <td>{{ $concept->id }}</td>
              <td>{{ $concept->title }}</td>
              <td>
                <button type="button" class="btn btn-primary btn-xs">Edit</button>
                <button type="button" class="btn btn-danger btn-xs">Delete</button>
              </td>
            </tr>
          @endforeach

        </tbody></table>
      </div>
    </div>
  </div>

</div>
@stop
