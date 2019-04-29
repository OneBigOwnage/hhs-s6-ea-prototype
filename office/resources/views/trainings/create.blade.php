@extends('adminlte::page')

@section('title', 'Concepts - New')

@section('content_header')
    <h1>Instantiate training</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-md-offset-3">
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">

          <form role="form" action="/trainings" method="POST">
            @csrf
            <div class="box-body">

              <div class="form-group">
                <label>Training</label>
                <select class="form-control" name="concept_id">

                  <option value="" disabled selected>(Choose a training)</option>

                  @foreach ($concepts as $concept)
                      <option value="{{ $concept->id }}">{{ $concept->title }}</option>
                  @endforeach

                </select>
              </div>

              <div class="form-group">
                <label>Ship</label>
                <select class="form-control" name="ship_id">

                  <option value="" disabled selected>(Choose a ship)</option>

                  @foreach ($ships as $ship)
                      <option value="{{ $ship->id }}">{{ $ship->name }}</option>
                  @endforeach

                </select>
              </div>

              <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="date" id="datepicker" autocomplete="off">
                </div>
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
