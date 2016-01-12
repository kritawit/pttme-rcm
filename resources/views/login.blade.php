@extends('layouts.login')
@section('content')
  <form action="{{ url('/login') }}" role="form" method="POST" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group has-feedback">
      <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder="Username">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div><!-- /.col -->
    </div>
  </form>
@stop