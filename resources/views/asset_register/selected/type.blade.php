@foreach ($types as $ty)
	<option value="{{$ty->type_id}}">{{$ty->description}}</option>
@endforeach