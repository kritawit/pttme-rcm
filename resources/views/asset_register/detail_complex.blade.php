@if(!empty($consequence)&&!empty($occorrence)&&!empty($detection))
<hr>
<div id="panel-save">
    <a href="#" class="btn btn-success" id="saveall" onclick="saveallcomplex();return false;"><i class="fa fa-save"></i>  Save</a>
    <hr>
</div>
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
                <td class="cell2"><textarea class="conseq" cols="35" readonly name="{{$conseq->id}}">{{$conseq->description}}</textarea></td>
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
    <form id="occorrence" action="{{url()}}/asset-register/saveocc" method="POST">
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
                    <td><input type="text" class="occe" style="width:100%;" readonly name="{{$occ->id}}" value="{{$occ->description}}"></td>
                    <td><input type="text" class="occe" style="width:100%;" readonly name="{{$occ->rows}}" value="{{$occ->ref1}}"></td>
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
                    <td><input type="text" class="det" style="width:100%;" readonly name="{{$dec->id}}" value="{{$dec->description}}"></td>
                    <td><input type="text" class="det" style="width:100%;" readonly name="{{$dec->rows}}" value="{{$dec->ref1}}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
</div>
@endif
{!! HTML::script('public/js/jquery.form.js') !!}
<script type="text/javascript">
$(document).ready(function() {

    var status = $("#status").val();
    if (status==0) {
        $("#panel-save").show();
    }else if(status==1){
        $("#panel-save").hide();
    }


    $("input[name=complex_conseq]").val($("#complex_id").val());
    $("input[name=node_conseq]").val($("#node_id").val());
    $("input[name=complex_occ]").val($("#complex_id").val());
    $("input[name=node_occ]").val($("#node_id").val());
    $("input[name=complex_dec]").val($("#complex_id").val());
    $("input[name=node_dec]").val($("#node_id").val());
});
function saveallcomplex(){

    if (checkForm()) {

        setdetail();
        $.ajax({
            url: '{{url()}}/asset-register/saveformlevel',
            type: 'POST',
            data: {
                node_id:$("#node_id").val(),
                com_id:$("#complex_id").val(),
                description:$("textarea#description").val(),
                asset_name:$("#asset_name").val(),
                data_type:$("input[name=data_type]").val(),
            },
            success:function(data){
                console.log('node detail : '+data);
            }
        });

        $.ajax({
            url: '{{url()}}/asset-register/saveconseq',
            type: 'POST',
            data: $("#consequence").serialize(),
            success:function(data){
                console.log('conseq : '+data);
                updatecomplexnode();
                loadcomplexdetail($("#complex_id").val());
            }
        });

        $("#occorrence").ajaxForm({
            dataType: 'json',
            success: function(data){
                console.log('occ : '+data);
                updatecomplexnode();
                loadcomplexdetail($("#complex_id").val());
            }
        }).submit();

        $.ajax({
            url: '{{url()}}/asset-register/savedec',
            type: 'POST',
            data: $("#detection").serialize(),
            success:function(data){
                console.log('dec : '+data);
                updatecomplexnode();
                loadcomplexdetail($("#complex_id").val());
            }
        });
        updatecomplexnode();
        setTimeout(function(){
            $("#tt").tree('reload');
            loadformlevel($("#node_id").val(),3,$("#asset_name").val());
        }, 1000);

    }else{
        alert('Input invalid!');
    }
}

</script>