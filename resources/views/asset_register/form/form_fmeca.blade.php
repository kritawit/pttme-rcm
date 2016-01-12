<form action="" id="frmFMECA" method="POST" class="form-horizontal" role="form">
	<input type="hidden" name="node" id="node" value="{{$node_id}}" placeholder="">
	<input type="hidden" name="id" id="id" value="{{$id}}" placeholder="">
	<div class="form-group">
		<div class="col-lg-12">
        <table width="100%">
          <tbody>
          <tr>
            <td class="cell3">
            	<label for="" class="control-label">Severity</label>
              	{!! Form::select('serv_id', ['' => 'Select one'] + $severity,$basic_failure->severity,['class'=>'form-control select2','id' => 'serv_id']) !!}
            </td>
            <td class="cell3">
            	<label for="" class="control-label">Occurrence</label>
              	{!! Form::select('occ_id', ['' => 'Select one'] + $occorrence,$basic_failure->occur,['class'=>'form-control select2','id' => 'occ_id']) !!}
            </td>
            <td class="cell3">
            	<label for="" class="control-label">Detection</label>
              	{!! Form::select('detection_id', ['' => 'Select one'] + $detection,$basic_failure->detect,['class'=>'form-control select2','id' => 'detection_id']) !!}
            </td>
            <td class="cell3">
              	<label for="" class="control-label">RPN No.</label>
              	<input type="number" name="rpn" readonly id="rpn" value="{{$basic_failure->rpn}}" class="form-control">
            </td>
          </tr>
        </tbody>
        </table>
	</div>
	</div>
			<div class="form-group">
              <label for="" class="control-label col-lg-6">Plant or Unit SD?</label>
              <div class="col-lg-6">
                <input type="text" name="ref1" id="ref1" value="{{$basic_failure->ref1}}"  required class="form-control">
              </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Damage Cost (Bath)</label>
            <div class="col-lg-6">
              <input type="text"  name="ref2" id="ref2" value="{{$basic_failure->ref2}}" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Spare part problem</label>
            <div class="col-lg-6">
              <input type="text" name="ref3" id="ref3" value="{{$basic_failure->ref3}}" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Maintenance Time</label>
            <div class="col-lg-6">
              <input type="text" name="ref4" id="ref4" value="{{$basic_failure->ref4}}" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Unit Preparation and Start up time</label>
            <div class="col-lg-6">
              <input type="text" name="ref5" id="ref5" value="{{$basic_failure->ref5}}" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Total Economic loss (Bath)</label>
            <div class="col-lg-6">
              <input type="text" value="{{$basic_failure->ref6}}" name="ref6" id="ref6" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Existing Detection method</label>
            <div class="col-lg-6">
              <input type="text" value="{{$basic_failure->ref7}}" name="ref7" id="ref7" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">None</label>
            <div class="col-lg-6">
              <input type="text" value="{{$basic_failure->ref8}}" name="ref8" id="ref8" required class="form-control">
            </div>
          </div>
	<hr>
	<div class="form-group">
        <label for="" class="control-label col-lg-6">Worst Case</label>
        <div class="col-lg-6">
			<textarea name="worst_case" class="form-control" cols="40" rows="3">{{$basic_failure->worst_case}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-lg-6">Failure Effect Remark</label>
        <div class="col-lg-6">
			<textarea name="failure_effect_remark" class="form-control" cols="40" rows="3">{{$basic_failure->failure_effect_remark}}</textarea>
        </div>
    </div>
</form>
<script type="text/javascript">
  $(function() {
    $('#detection_id').change(function() {
      if (checkNull()) {
        var rpn = null;
        var det = parseInt($('#detection_id option:selected').text());
        var serv = parseInt($('#serv_id option:selected').text());
        var occ = parseInt($('#occ_id option:selected').text());
        rpn = serv*occ*det;
        $("#rpn").val(rpn);
      }
    });
    $('#serv_id').change(function() {
      if (checkNull()) {
        var rpn = null;
        var det = parseInt($('#detection_id option:selected').text());
        var serv = parseInt($('#serv_id option:selected').text());
        var occ = parseInt($('#occ_id option:selected').text());
        rpn = serv*occ*det;
        $("#rpn").val(rpn);
      }
    });
    $('#occ_id').change(function() {
      if (checkNull()) {
        var rpn = null;
        var det = parseInt($('#detection_id option:selected').text());
        var serv = parseInt($('#serv_id option:selected').text());
        var occ = parseInt($('#occ_id option:selected').text());
        rpn = serv*occ*det;
        $("#rpn").val(rpn);
      }
    });
  });
  function checkNull(){
    if ($('#detection_id').val()=='') {
      alert('Detection invalid!');
      $('#detection_id').focus();
      return false;
    }else if($('#serv_id').val()==''){
      alert('Severity invalid!');
      $('#serv_id').focus();
      return false;
    }else if($('#occ_id').val()==''){
      alert('Occurrence invalid!');
      $('#occ_id').focus();
      return false;
    }else{
      return true;
    }
  }
</script>