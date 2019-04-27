@extends('adminlte::page')

@section('title', 'Trainings')

@section('content_header')
    <h1>Trainings</h1>
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
                <th>Title</th>
                <th>Ship</th>
                <th>Date</th>
                <th>Status</th>
              </tr>

              @foreach ($trainings as $training)
                <tr>
                  <td>{{ $training->id }}</td>
                  <td>{{ $training->title }}</td>
                  <td>{{ $training->ship->name }}</td>
                  <td>{{ $training->date->format('d-m-Y') }}</td>

                  @if ($training->is_done)
                    <td><span class="badge bg-green">Done</span></td>
                    @else
                    <td><span class="badge bg-red">Not done</span></td>
                  @endif

                </tr>
              @endforeach

            </tbody></table>
        </div>
      </div>
    </div>

  </div>
@stop
