@extends('adminlte::page')

@section('title', "Training - {$training->title}")

@section('content_header')
    <h1>Show training</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-md-offset-3">
      <div class="box">
        <div class="box-header">
          @if ($training->is_done)
            <span class="badge bg-green">Done</span>
            @else
            <span class="badge bg-red">Not done</span>
          @endif
        </div>
          <div class="box-body">

            <h4 style="margin-bottom: 0;">{{ $training->title }}</h4>
            <p style="margin-bottom: 0; color: grey;">
              Date: {{ $training->date->format('m/d/Y') }}
              <br>
              Ship: {{ $training->ship->name }}
            </p>

            <br>

            <div class="form-group">
              <label>Instructions</label>
              <p>
                {{ $training->instructions }}
              </p>
            </div>

            @if($training->is_done)

              <hr>

              <div class="form-group">
                <label>Feedback from ship:</label>
                <p> {{ $training->feedback }} </p>
              </div>
            @endif

          </div>
      </div>
    </div>

  </div>
@stop

@section('css')
  <link rel="stylesheet" href="/css/datepicker.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@stop

@section('js')
<script src="/js/datepicker.js"></script>
<script>
$('#datepicker').datepicker({
  autoclose: true
})
</script>
@stop
