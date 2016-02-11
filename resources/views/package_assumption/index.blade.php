@extends('layouts.app')

@section('content')
<section class="content-header">
        <h1>
            {{ Session::get('project') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Package and Assumption</li>
        </ol>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12">
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
			{!! Form::open(array('url'=>'package-assumption/package','role'=>'form')) !!}
			<input type="hidden" name="id" value="<?php if(!empty($package)){ echo $package->id; }?>">
				<table class="table table-striped table-hover" width="100%">
					<thead>
						<tr>
							<th colspan="2" style="text-align: center;background-color:cyan;">Package Function And Assumption</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align: left;">Package Name : </td>
							<td>
								<input type="text" name="package_name" value="<?php if (!empty($package)) {echo $package->package_name;}?>" class="form-control">
							</td>
						</tr>
						<tr>
							<td style="text-align: left;">Production Process Function : </td>
							<td>
								<textarea name="product_process_function" cols="120" rows="5"><?php if (!empty($package)) {
									echo $package->product_process_function;
								} ?></textarea>
							</td>
						</tr>
						<tr>
							<td style="text-align: left;">Assumption for RCM analysis : </td>
							<td>
								<textarea name="assumtion_for_rcm" cols="120" rows="5"><?php if (!empty($package)) {
									echo $package->assumtion_for_rcm;
								} ?></textarea>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;" colspan ="2">
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
								<button type="reset" class="btn btn-danger">Clear</button>
							</td>
						</tr>
					</tbody>
				</table>
			{!! Form::close() !!}
			</div>
		</div>
</section>
	@include('include.normal-js')
@stop