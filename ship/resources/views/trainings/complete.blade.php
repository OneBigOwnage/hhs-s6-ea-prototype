@extends('adminlte::page')

@section('title', "Complete training - {$training->title}")

@section('content_header')
    <h1>Complete training</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-md-offset-3">
      <div class="box">
          <form action="/trainings/{{ $training->id }}/complete" method="POST">
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

            <hr>


              @csrf

              <div class="form-group">
                <label for="training_feedback_input">Feedback <span style="color: grey;">(optional)</span></label>
                <textarea style="resize: vertical;" class="form-control" id="training_feedback_input" name="feedback" rows="5" placeholder="Feedback..." spellcheck="false"></textarea>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>

          </form>
      </div>
    </div>

  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@stop
