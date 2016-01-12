@if(!empty($consequence)&&!empty($occorrence)&&!empty($detection))
<hr>
<a href="#" class="btn btn-success" id="saveall" onclick="saveallcomplex();return false;"><i class="fa fa-save"></i>  Save</a>
<hr>
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Consequence</a></li>
    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Occurrence</a></li>
    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Detection</a></li>
  </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="tab_1" style="overflow: scroll;">
<?php $header = 0; ?>
@if(!empty($consequence))
<form id="consequence" action="" method="POST">
<input type="hidden" name="complex_conseq" value="">
<input type="hidden" name="node_conseq" value="">
<table border="1" style="width:100%">
<thead align="center">
<tr>
  <th></th>
  @foreach($header_consequence as $header)
    <th style="text-align:center;">{{$header->description}}</th>
  @endforeach
</tr>
</thead>
<tboby>
    @foreach ($rows_consequence as $rows_conseq)
    <tr>
        <td width="5%" align="center">{{$rows_conseq->description}}</td>
        @foreach ($consequence as $conseq)
            @if ($conseq->rows == $rows_conseq->rows)
                <td class="cell2"><textarea class="conseq" disabled name="{{$conseq->id}}">{{$conseq->description}}</textarea></td>
            @endif
        @endforeach
    <tr>
    @endforeach
</tboby>
</table>
</form>
@endif
    </div><!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
    <form id="occorrence" method="POST">
    <input type="hidden" name="complex_occ" value="">
    <input type="hidden" name="node_occ" value="">
        <table class="table table-hover" width="100%">
            <thead>
                <tr >
                    <th align="center">Code</th>
                    <th>Scale</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($occorrence as $occ)
                <tr>
                    <td width="5%" align="center">{{$occ->rows}}</td>
                    <td><input type="text" class="occe" style="width:100%;" disabled="" name="{{$occ->id}}" value="{{$occ->description}}"></td>
                    <td><input type="text" class="occe" style="width:100%;" disabled="" name="{{$occ->rows}}" value="{{$occ->ref1}}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    </div><!-- /.tab-pane -->
    <div class="tab-pane" id="tab_3">
    <form id="detection" method="POST">
    <input type="hidden" name="complex_dec" value="">
    <input type="hidden" name="node_dec" value="">
        <table class="table table-hover" width="100%">
            <thead>
                <tr >
                    <th align="center">Code</th>
                    <th>Scale</th>
                    <th>ตัวอย่าง</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($detection as $dec)
                <tr>
                    <td width="10%" align="center">{{$dec->rows}}</td>
                    <td><input type="text" class="det" style="width:100%;" disabled="" name="{{$dec->id}}" value="{{$dec->description}}"></td>
                    <td><input type="text" class="det" style="width:100%;" disabled="" name="{{$dec->rows}}" value="{{$dec->ref1}}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
</div>
@endif
<script type="text/javascript">
$(document).ready(function() {
    $("input[name=complex_conseq]").val($("#complex_id").val());
    $("input[name=node_conseq]").val($("#complex_node").val());
    $("input[name=complex_occ]").val($("#complex_id").val());
    $("input[name=node_occ]").val($("#complex_node").val());
    $("input[name=complex_dec]").val($("#complex_id").val());
    $("input[name=node_dec]").val($("#complex_node").val());
});
function saveallcomplex(){
    var data_type = $("input[type='radio'][name='data_type']:checked").val();
    if (data_type == 2) {
      $.ajax({
        url: '{{url()}}/asset-register/saveconseq',
        type: 'POST',
        data: $("#consequence").serialize(),
        success:function(data){
            console.log('conseq : '+data);
            updatecomplexnode();
            loadcomplexdetail($("#complex_id").val());
            document.getElementById("default").checked = true;
        }
      });
      $.ajax({
        url: '{{url()}}/asset-register/saveocc',
        type: 'POST',
        data: $("#occorrence").serialize(),
        success:function(data){
            console.log('occ : '+data);
            updatecomplexnode();
            loadcomplexdetail($("#complex_id").val());
            document.getElementById("default").checked = true;
        }
      });
      $.ajax({
        url: '{{url()}}/asset-register/savedec',
        type: 'POST',
        data: $("#detection").serialize(),
        success:function(data){
            console.log('dec : '+data);
            updatecomplexnode();
            loadcomplexdetail($("#complex_id").val());
            document.getElementById("default").checked = true;
        }
      });
    }
}
</script>