<button type="button" class="btn btn-warning" onclick="addquest();">Add Question</button>
<br>
<br>
<br>
@foreach ($question as $q)
	<div class="form-group">
    	<div class="col-lg-3">
        	<input type="text" class="form-control" name="question[]" value="{{$q->questions}}">
    	</div>
    	<div class="col-lg-6">
        	<input type="text" class="form-control" name="answers[]" >
    	</div>
	</div>
@endforeach