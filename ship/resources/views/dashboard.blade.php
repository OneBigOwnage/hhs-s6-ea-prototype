@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-sync" id="communicate-icon"></i></span>

        <div class="info-box-content" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 90px;">
          <a href="/sync" class="info-box-text btn btn-info" id="communicate-button">Communicate with the office</a>
        </div>
      </div>
    </div>
  </div>

  @if (session()->has('syncMessage'))
    <div class="row" style="margin-top: 3rem;">
      <div class="col-md-3 col-md-offset-4 alert alert-success">
        <h4><i class="icon fa fa-check"></i>Done</h4>
        {{ session('syncMessage') }}
      </div>
    </div>
  @endif

  @if ($toSync > 0)
    <div class="row" style="margin-top: 3rem;">
      <div class="col-md-3 col-md-offset-4 alert alert-warning">
        <h4><i class="icon fa fa-check"></i>Please sync</h4>
        There are {{ $toSync }} training(s) to be sent to the office.
      </div>
    </div>
  @endif

@stop

@section('js')
<script>
  $('#communicate-button').on('click', function () {
    $('#communicate-icon').addClass('fa-spin');
  });
</script>
@endsection

@section('css')
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
@endsection
