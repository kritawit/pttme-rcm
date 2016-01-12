@extends('layouts.app')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @if(Session::has('project'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b><span class="fa fa-folder-open"></span>  Open project : {{ Session::get('project')}}</b>
          </div>
        @endif
      </div>
    </div>
  </section><!-- /.content -->
@include('include.normal-js')
@endsection

