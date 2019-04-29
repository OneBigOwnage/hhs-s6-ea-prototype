@extends('adminlte::page')

@section('title', 'Concepts - New')

@section('content_header')
    <h1>Add training to library</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-md-offset-3">
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">

          <form role="form" action="/concepts" method="POST">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="training_title_input">Training title</label>
                <input type="text" name="title" class="form-control" id="training_title_input" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="training_instructions_input">Training instructions</label>
                <textarea class="form-control" id="training_instructions_input" name="instructions" rows="5" placeholder="Instructions..." spellcheck="false"></textarea>
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>
@stop

@section('css')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
