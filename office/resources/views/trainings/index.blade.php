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
          <a href="/trainings/create" class="btn btn-success btn-xs">New</a>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Training</th>
                <th>Ship</th>
                <th>Date</th>
                <th>Status</th>
                <th>Feedback</th>
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

                  <td>{{ $training->feedback ?? '-' }}</td>

                </tr>
              @endforeach

            </tbody></table>
        </div>
      </div>
    </div>

  </div>
@stop
