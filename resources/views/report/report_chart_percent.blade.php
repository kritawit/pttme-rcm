@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
           <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
           <li class="active">Report - (%) Unit Chart</li>
         </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Report - (%) Unit Chart</h3>
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
                {!! Form::open(array('url'=>'report/chartpercent','class'=>'form-horizontal','role'=>'form')) !!}
                <fieldset>
                  <div class="form-group">
                  <label for="stu_title" class="col-lg-2 control-label"><b>Equipment Type : </b></label>
                    <div class="col-lg-4" id="classrm">
                        <select name="chart_type" class="form-control select2">
                          <option value="">Select one</option>
                          <option value="1">By Equipment Categories</option>
                          <option value="2">By Equipment Type</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-lg-2"></label>
                    <div class="col-md-4">
                      <button type="submit" formtarget="_blank" class="btn btn-success"><span class="fa fa-print"></span> Preview</button>
                    </div>
                  </div>
                </fieldset>
                {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div>
            </div>
        </div>
    </section>
    @include('include.normal-js')
@stop