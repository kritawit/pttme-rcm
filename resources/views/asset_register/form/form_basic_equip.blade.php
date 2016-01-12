<div class="form-group">
	<label for="" class="control-label col-lg-3">Category:</label>
	<div class="col-lg-8">
		{!! Form::select('cat_id', ['' => 'Select one'] + $category,null,['class'=>'form-control','id' => 'cat_id']) !!}
	</div>
</div>
<div class="form-group">
	<label for="" class="control-label col-lg-3">Type:</label>
	<div class="col-lg-8">
		<select name="type_id" class="form-control" id="types">
            <option value="" selected>Select one</option>
        </select>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#cat_id').change(function() {
      	if ($(this).val()!='') {
        	$.ajax({
          		url: '{{url("/")}}/asset-register/type',
          		type: 'GET',
          		data: {cat_id:$(this).val()},
          		success:function(data){
            		$("#types").html(data);
          		}
        	});
      		}else{
        		$("#parts").html('<option value="" selected>Select one</option>');
        		$("#types").html('<option value="" selected>Select one</option>');
      		}
    	});
	});
</script>