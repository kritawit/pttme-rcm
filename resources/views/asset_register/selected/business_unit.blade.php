<label for="" class="control-label">Business Unit</label>
@if($id = 0)
{!! Form::select('business_unit_type_colums', ['' => 'Select one'] + $unit,null,['class'=>'form-control select2','id' => 'business_unit_type_colums']) !!}
@else
{!! Form::select('business_unit_type_colums', $unit,$id,['class'=>'form-control select2','id' => 'business_unit_type_colums']) !!}
@endif