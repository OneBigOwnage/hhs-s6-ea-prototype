@extends('adminlte::page')

@section('title', 'Operating hours - New')

@section('content_header')
    <h1>
      Operating hours <small>Create new</small>
    </h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-md-offset-3">
      <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">

          <form role="form" action="/operating-hours" method="POST">
            @csrf
            <div class="box-body">

              <div class="form-group">
                <label>Device</label>
                <select class="form-control" name="device">

                  <option value="" disabled selected>(Choose a device)</option>

                  @foreach ($availableDevices as $name)
                      <option value="{{ $name }}">{{ $name }}</option>
                  @endforeach

                </select>
              </div>

              <div class="form-group">
                <label for="hours_input">Hours</label>
                <input type="text" name="hours" class="form-control" id="hours_input" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Reading date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" name="reading_date" autocomplete="off">
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
$('.datepicker').datepicker({
  autoclose: true
})
</script>
@stop
