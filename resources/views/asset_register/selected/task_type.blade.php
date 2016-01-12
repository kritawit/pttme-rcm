@if (!empty($types))
	{!! Form::select('task_type',$types,null,['class'=>'form-control','id' => 'task_type']) !!}
@else
	<select name="task_type" class="form-control" id="task_type">
		<option value="" selected>Select one</option>
	</select>
@endif