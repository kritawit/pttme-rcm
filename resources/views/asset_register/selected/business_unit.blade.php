<label for="" class="control-label">Business Unit</label>
{!! Form::select('business_unit_type_colums', ['' => 'Select one'] + $unit,null,['class'=>'form-control select2','id' => 'business_unit_type_colums']) !!}