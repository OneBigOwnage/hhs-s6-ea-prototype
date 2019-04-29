@extends('adminlte::page')

@section('title', 'Trainings')

@section('content_header')
    <h1>Trainings</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-10 col-md-offset-1">
      <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-striped">
              <tbody><tr>
                <th style="width: 10px">#</th>
                <th>Title</th>
                <th>Date</th>
                <th>Status</th>
                <th style="width: 125px">Actions</th>
              </tr>

              @foreach ($trainings as $training)
                <tr>
                  <td>{{ $training->id }}</td>
                  <td>{{ $training->title }}</td>
                  <td>{{ $training->date->format('d-m-Y') }}</td>

                  @if ($training->is_done)
                    <td><span class="badge bg-green">Done</span></td>
                    @else
                    <td><span class="badge bg-red">Not done</span></td>
                  @endif

                  <td>
                    <a href="/trainings/{{ $training->id }}" class="btn btn-primary btn-xs">Show</a>

                    @if(! $training->is_done)
                      <a href="/trainings/{{ $training->id }}/complete" class="btn btn-success btn-xs">Complete</a>
                    @endif

                  </td>

                </tr>
              @endforeach

            </tbody></table>
        </div>
      </div>
    </div>

  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
