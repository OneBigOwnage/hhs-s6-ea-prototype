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
            <a href="/trainings/{{ $training->id }}/complete" class="btn btn-success btn-xs">Complete</a>
          @endif
        </div>
          <div class="box-body">

            <h4 style="margin-bottom: 0;">{{ $training->title }}</h4>
            <p style="padding-top: 0; color: grey;">Date: {{ $training->date->format('m/d/Y') }}</p>

            <br>

            <div class="form-group">
              <label>Instructions</label>
              <p>
                {{ $training->instructions }}
              </p>
            </div>

            @isset($training->feedback)

              <hr>

              <div class="form-group">
                <label>Your feedback</label>
                <p>
                  {{ $training->feedback }}
                </p>
              </div>
            @endif

          </div>
      </div>
    </div>

  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/datepicker.css">
@stop

@section('js')
<script src="/js/datepicker.js"></script>
<script>
$('#datepicker').datepicker({
  autoclose: true
})
</script>
@stop
