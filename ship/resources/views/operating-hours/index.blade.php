@extends('adminlte::page')

@section('title', 'Operating hours')

@section('content_header')
    <h1>Operating hours</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-10 col-md-offset-1">
      <div class="box">
        <div class="box-header">
          <a href="/operating-hours/create" class="btn btn-success btn-xs">New</a>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Device</th>
                  <th>Hours</th>
                  <th>Reading date</th>
                </tr>

                @foreach ($operatingHours as $hours)
                  <tr>
                    <td>{{ $hours->id }}</td>
                    <td>{{ $hours->device }}</td>
                    <td>{{ $hours->hours }}</td>
                    <td>{{ $hours->reading_date }}</td>
                  </tr>
                @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
