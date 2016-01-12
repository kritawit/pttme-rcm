@foreach ($parts as $pr)
	<option value="{{$pr->part_id}}">{{$pr->description}}</option>
@endforeach