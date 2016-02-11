<form action="" id="frmFMECA" method="POST" class="form-horizontal" role="form">
	<input type="hidden" name="node_fmeca" id="node_fmeca" value="{{$node_id}}" placeholder="">
  <input type="hidden" name="node" id="node" value="{{$node_id}}" placeholder="">
	<input type="hidden" name="id" id="id" value="{{$id}}" placeholder="">
        <div class="form-group">
              <label for="" class="control-label col-lg-3">Severity</label>
              <div class="col-lg-2">
                {!! Form::select('serv_id', ['' => 'Select one'] + $severity,$basic_failure->severity,['class'=>'form-control select2','id' => 'serv_id']) !!}
              </div>
          </div>
          <div class="form-group">
              <label for="" class="control-label col-lg-3">Occurrence</label>
              <div class="col-lg-6">
                {!! Form::select('occ_id', ['' => 'Select one'] + $occorrence,$basic_failure->occur,['class'=>'form-control select2','id' => 'occ_id']) !!}
              </div>
          </div>
          <div class="form-group">
              <label for="" class="control-label col-lg-3">Detection</label>
              <div class="col-lg-6">
                {!! Form::select('detection_id', ['' => 'Select one'] + $detection,$basic_failure->detect,['class'=>'form-control select2','id' => 'detection_id']) !!}
              </div>
          </div>
          <div class="form-group">
              <label for="" class="control-label col-lg-3">RPN No.</label>
              <div class="col-lg-6">
                <input type="number" name="rpn" readonly id="rpn" value="{{$basic_failure->rpn}}" class="form-control">
              </div>
          </div>
			   <div id="body-question">

         </div>
	     <hr>
	<div class="form-group">
        <label for="" class="control-label col-lg-3">Worst Case</label>
        <div class="col-lg-6">
			<textarea name="worst_case" class="form-control" cols="40" rows="3">{{$basic_failure->worst_case}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-lg-3">Failure Effect Remark</label>
        <div class="col-lg-6">
			<textarea name="failure_effect_remark" class="form-control" cols="40" rows="3">{{$basic_failure->failure_effect_remark}}</textarea>
        </div>
    </div>
</form>
<script type="text/javascript">
  $(function() {
    if ($("#id").val()!='') {
      // alert($("#id").val());
      $.ajax({
        url: '{{url()}}/asset-register/formquestion',
        type: 'GET',
        data: {
          id: $("#id").val()
        },
        success:function(data){
          $("#body-question").html(data);
        }
      });
      // $("#body-question").load("{{url()}}/asset-register/formquestion?id=".$("#id").val());
    }

    $('#detection_id').change(function() {
      if (checkNull()) {
        var rpn = null;
        var det = parseInt($('#detection_id option:selected').text());
        var serv = parseInt($('#serv_id option:selected').text());
        var occ = parseInt($('#occ_id option:selected').text());
        rpn = serv*occ*det;
        $("#rpn").val(rpn);
        loadquestion();
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
        loadquestion();
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
        loadquestion();
      }
    });
  });
  function checkNull(){
    if ($('#serv_id').val()=='') {
      $('#serv_id').focus();
      $("#body-question").html('');
      return false;
    }else if($('#occ_id').val()==''){
      $('#occ_id').focus();
      $("#body-question").html('');
      return false;
    }else if($('#detection_id').val()==''){
      $('#detection_id').focus();
      $("#body-question").html('');
      return false;
    }else{
      return true;
    }
  }
  function loadquestion(){
    $.ajax({
      url: '{{url()}}/asset-register/calulatequestion',
      type: 'GET',
      data: {
        node_fmeca:$("#node_fmeca").val(),
        occ_id:$("#occ_id").val(),
        detection_id:$("#detection_id").val(),
        serv_id:$("#serv_id").val(),
      },
      success:function(data){
        console.log(data);
        if (data.ref1 == 'Non Critical') {
          $("#body-question").load("{{url()}}/asset-register/questiondefault");
        }else if (data.ref1 == 'Critical') {
          $("#body-question").html('');
        }else{
          $("#body-question").html('');
        }
      }
    });
  }
  function addquest () {
    var i = 1;
      $("#body-question").append('<div class="form-group" id="'+i+'"><div class="col-lg-3"><input name="question[]" class="form-control"></div><div class="col-lg-6"><input class="form-control" name="answers[]"></div><button type="button" class="btn btn-warning" onclick="removequest('+i+');">Remove Question</button></div>');
    i++;
  }
  function removequest(id){
    $.ajax({
      url: '{{url()}}/asset-register/removequestion',
      type: 'GET',
      data: {
        id: id
      },
      success:function(data){
        if (data === 'success') {
          var div = "#"+id;
          $(div).remove();
        }
      }
    });
  }
</script>