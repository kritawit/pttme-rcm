<button type="button" class="btn btn-warning" onclick="addquest();">Add Question</button>
<br>
<br>
@foreach ($question as $q)
	<div class="form-group" id="{{$q->id}}">
    	<div class="col-lg-3">
        	<input type="text" class="form-control" name="question[]" value="{{$q->questions}}">
    	</div>
    	<div class="col-lg-6">
        	<input type="text" class="form-control" name="answers[]" value="{{$q->answers}}">
        	<input type="hidden" class="form-control" name="question_id[]" value="{{$q->id}}">
    	</div>
    	<button type="button" class="btn btn-warning" onclick="removequest({{$q->id}});">Remove Question</button>
	</div>
@endforeach