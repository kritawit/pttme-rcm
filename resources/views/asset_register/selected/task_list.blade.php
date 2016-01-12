@if (!empty($type_list))
	{!! Form::select('basic_task_id',$type_list,null,['class'=>'form-control','id' => 'basic_task_id']) !!}
@else
	<select name="basic_task_id" class="form-control" id="basic_task_id">
		<option value="" selected>Select one</option>
	</select>
@endif