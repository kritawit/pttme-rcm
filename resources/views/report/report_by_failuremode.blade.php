@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
           <li><a href="{{ url('/dash-board') }}"><i class="fa fa-dashboard"></i> Dash board</a></li>
           <li class="active">Report - By Failure Mode</li>
         </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Report - By Failure Mode</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                @if($errors->has())
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <p>The follow errors have occurred:</p>
                  <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
                @endif
                {!! Form::open(array(
                  'url'=>'report/failuremode',
                  'class'=>'form-horizontal',
                  'target'=>'_blank',
                  'role'=>'form'
                  )) !!}
                <fieldset>
                <div class="form-group">
                  <label for="stu_title" class="col-lg-2 control-label"><b>Failure Mode : </b></label>
                        <div class="col-lg-4" id="gradename">
                          {!! Form::select('mode_id',['' => 'Select All']+ $mode,null,['class'=>'form-control select2']) !!}
                        </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-lg-2"></label>
                    <div class="col-md-4">
                       <button type="submit" class="btn btn-success"><span class="fa fa-print"></span> Preview</button>
                    </div>
                  </div>
                </fieldset>
                {!! Form::close() !!}
                <hr>
                </div><!-- /.box-body -->
            </div>
            </div>
        </div>
    </section>
    @include('include.normal-js')
@stop