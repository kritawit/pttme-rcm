@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ Session::get('project') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Asset Register - Asset Hierarchy Level</li>
        </ol>
    </section>
    <section class="content">
    @if($errors->has())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>The Following Errors have occurred:</p>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    @if(Session::has('message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>The Following Success have occurred:</p>
        <ul>
        <li>{{ Session::get('message') }}</li>
        </ul>
    </div>
    @endif
    @if(Session::has('message_import'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>The Following Success have occurred:</p>
        <ul>
        <li>{{ Session::get('message_import') }}</li>
        </ul>
    </div>
    @endif
    <div class="row">
        {{-- <div class="col-sm-12"> --}}
            <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"><button type="button" id="create_node" class="btn btn-success"><i class="fa fa-plus"></i> New Asset Hierarchy</button></h3>
                  <h3 class="box-title"><button type="button" id="import_node" class="btn btn-warning"><i class="fa fa-file-text"></i> Import Asset Hierarchy</button></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body" id="tree-content">
                    <div class="col-lg-3" style="overflow:scroll; height:900px;">
                        <ul id="tt" class="easyui-tree" data-options="url: '{{url()}}/asset-register/tree',
                    method: 'get',
                    animate: true">
                        </ul>
                        <div id="mm" class="easyui-menu" style="width:120px;">
                        <div onclick="append();" data-options="iconCls:'icon-add'">Create</div>
                        <div onclick="removeit();" data-options="iconCls:'icon-remove'">Remove</div>
                        <div class="menu-sep"></div>
                        <div onclick="expand()">Expand</div>
                        <div onclick="collapse()">Collapse</div>
                        </div>
                    </div>
                    <div class="col-lg-9" id="control-panel" style="overflow:scroll; height:900px;">
                        
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </div>
        <div class="modal fade" id="modal-node">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="title-name">Asset Name : </h4>
                    </div>
                <div class="modal-body">
                <input type="hidden" id="level_node" >
                <form id="frmNode" class="form-horizontal" onsubmit="savenode();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                <div class="form-group">
                    <div class="col-lg-12">
                    <input type="hidden" name="node_id_asset" id="node_id_asset">
                    <input type="text" name="asset_name" id="asset_name" class="form-control">
                    </div>
                    <div class="col-lg-12" id="bss_unit">

                    </div>
                </div>
                <div id="select-equip">

                </div>
                </fieldset>
                </form>
                <div class="modal-footer">
                    <button type="button" onclick="savenode();return false;" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        <div class="modal fade" id="modal-newnode">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Company Name:</h4>
                    </div>
                <div class="modal-body">
                <div class="form-horizontal">
                <fieldset>
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="text" name="node_name" id="node_name" class="form-control">
                    </div>
                  </div>
                </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="savenewnode();" class="btn btn-success"> New</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        
        {{-- Modal Import  --}}
    <div class="modal fade" id="modal-import">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Import Asset Hierarchy</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'asset-register/importasset','class'=>'form-horizontal','role'=>'form','method'=>'POST', 'files'=>true,'id'=>'frmImport')) !!}
                    <fieldset>
                        <div class="form-group">
                            {!! Form::label('name','File Excel : ',array('class'=>'col-lg-3 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::file('import',['class'=>'form-control','id' => 'import']) !!}
                                </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-file-text"></i> Import</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    </section>
    @include('include.normal-js')
    {!! HTML::script('public/easyui/jquery.easyui.min.js') !!}
    {!! HTML::script('public/js/ptt-rcm.js') !!}
    <script type="text/javascript">
        $(function() {
        $('#modal-node').on('shown.bs.modal', function () {
            $('#asset_name').focus()
        });
        var urljson = '{{url()}}/asset-register/tree';
        $('#tt').tree({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: urljson,
                loadFilter: function(rows,data,parent){
                    return convert(rows);
                },
                onClick: function(node){
                    $.ajax({
                        url: '{{url()}}/asset-register/level',
                        type: 'GET',
                        data: {id: node.id},
                        dataType:'json',
                        success:function(data){
                            $("#control-panel").html('<img class="img-load" src="../public/images/loader.GIF" alt="">');
                            loadformlevel(node.id,data[0].level,data[1].name);
                        }
                    });
                },
            onContextMenu: function(e,node){
                e.preventDefault();
                $.ajax({
                    url: '{{url()}}/asset-register/level',
                    type: 'GET',
                    data: {id: node.id},
                    dataType:'json',
                    success:function(data){
                        var l = data[0].level;
                        getpropertieslevel(data[0].level);
                    }
                });

                $(this).tree('select',node.target);
                $('#mm').menu('show',{
                    left: e.pageX,
                    top: e.pageY
                });
            }
        });
    });

    function getpropertieslevel(level){
        if (level == 1) {
            $.ajax({
                url: '{{url()}}/asset-register/propertieslevel',
                type: 'GET',
                data: {
                    level: level
                },
                success:function(data){
                    $("#bss_unit").html(data);
                }
            });
        }else{
            $("#bss_unit").html('');
        }
    }

        $("#create_node").click(function(event) {
            $("#node_name").val('');
            $("#modal-newnode").modal('show');
            $("#node_name").focus();
        });

        $("#import_node").click(function(event) {
            $("#modal-import").modal('show');
        });

        function savenewnode(){
            if ($("#node_name").val()!='') {
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{url()}}/asset-register/addnode',
                    type: 'POST',
                    data: {
                        node: $("#node_name").val(),
                    },
                    success:function(data){
                    if(data === 'success'){
                        $("#node_name").val('');
                        $("#modal-newnode").modal('hide');
                        $("#tt").tree('reload');
                    }else{
                        $("#modal-newnode").modal('hide');
                        alert('save node fail!');
                    }
                    }
                    });
            }else{
                alert('node name is valid!');
                $("#node_name").focus();
            }
            return false;
        }
        function convert(rows){
            function exists(rows, parentId){
                for(var i=0; i<rows.length; i++){
                    if (rows[i].id == parentId) return true;
                }
                return false;
            }
            var nodes = [];
            // get the top level nodes
            for(var i=0; i<rows.length; i++){
                var row = rows[i];
                if (!exists(rows, row.parentId)){
                    nodes.push({
                        id:row.id,
                        text:row.name
                    });
                }
            }

            var toDo = [];
            for(var i=0; i<nodes.length; i++){
                toDo.push(nodes[i]);
            }
            while(toDo.length){
                var node = toDo.shift();    // the parent node
                // get the children nodes
                for(var i=0; i<rows.length; i++){
                    var row = rows[i];
                    if (row.parentId == node.id){
                        var child = {id:row.id,text:row.name};
                        if (node.children){
                            node.children.push(child);
                        } else {
                            node.children = [child];
                        }
                        toDo.push(child);
                    }
                }
            }
            return nodes;
        }

        function checkFormEquip(){
            var rs =true;
            if ($("#cat_id").val()=='') {
                alert('Category invalid!');
                $("#cat_id").focus();
                rs=false;
            }

            if ($("#type_id").val()=='') {
                alert('Type invalid!');
                $("#type_id").focus();
                rs=false;
            }
            return rs;
        }


        function savenode(){
            if($("#asset_name").val() != ""){
                if ($("#level_node").val()==7) {
                    if (checkFormEquip()) {
                        $("#modal-node").modal('hide');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{url()}}/asset-register/addsubnode',
                            type: 'POST',
                            data: $("#frmNode").serialize(),
                            success:function(data){
                                if(data === 'success'){
                                    $("#tt").tree('reload');
                                }else if(data === 'fail'){
                                    alert('add node fail!');
                                }
                            }
                        });
                    }
                }else if($("#level_node").val()==1){
                    if (checkFormLevelTwo()) {
                        $("#modal-node").modal('hide');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{url()}}/asset-register/addsubnode',
                            type: 'POST',
                            data: $("#frmNode").serialize(),
                            success:function(data){
                                if(data === 'success'){
                                    $("#tt").tree('reload');
                                }else if(data === 'fail'){
                                    alert('add node fail!');
                                }
                            }
                        });
                    }
                }else{
                    $("#modal-node").modal('hide');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{url()}}/asset-register/addsubnode',
                        type: 'POST',
                        data: $("#frmNode").serialize(),
                        success:function(data){
                            if(data === 'success'){
                                $("#tt").tree('reload');
                            }else if(data === 'fail'){
                                alert('add node fail!');
                            }
                        }
                    });
                }
            }else{
                alert('Asset name invalid !');
                $("#asset_name").focus();
            }
        }


        function append(){
            var t = $('#tt');
            var node = t.tree('getSelected');
            if (checkLevel(node.id)==true) {
                $("#modal-node").modal('show');
            }
            
            $("#title-name").html(node.text);
            $("#asset_name").val('');
            $("#node_id_asset").val(node.id);
        }

        function removeit(){
            var node = $('#tt').tree('getSelected');
            $('#tt').tree('remove', node.target);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{url()}}/asset-register/removenode',
                type: 'POST',
                data: {id: node.id},
                success:function(data){
                    if(data === 'success'){
                        $("#tt").tree('reload');
                    }else if(data === 'fail'){
                        alert('remove node fail!');
                    }
                }
            });
        }

    function checkFormLevelTwo(){
        if ($("#asset_name").val()=='') {
            alert('Asset name invalid !');
            $("#asset_name").focus();
            return false;
        }else if ($("#business_unit_type_colums").val()=='') {
            alert('Business Unit Type invalid !');
            $("#business_unit_type_colums").focus();
            return false;
        }else{
            return true;
        }
    }

    function collapse(){
        var node = $('#tt').tree('getSelected');
        $('#tt').tree('collapse',node.target);
    }
    function expand(){
        var node = $('#tt').tree('getSelected');
        $('#tt').tree('expand',node.target);
    }

    function checkLevel(node){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{url()}}/asset-register/level',
            type: 'GET',
            data: {id: node},
            dataType:'json',
            success:function(data){
                if (data[0].level < 8) {
                    $("#modal-node").modal('show');
                    if (data[0].level == 7) {
                        $("#level_node").val(data[0].level);
                        $("#select-equip").load('{{url()}}/asset-register/equiponnode');
                    }else if(data[0].level==1){
                        $("#level_node").val(data[0].level);
                        $("#select-equip").html('');
                    }else{
                        $("#level_node").val(data[0].level);
                        $("#select-equip").html('');
                    }
                    return true;
                }else{
                    alert('maximum level 8 !');
                    return false;
                }
            }
        });
    }

    function loadformlevel(id,level,name){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{url()}}/asset-register/formlevel',
                type: 'GET',
                data:{
                    name:name,
                    id:id,
                    level:level,
                },
                success:function(data){
                    $("#control-panel").html(data);
                }
            });
        }
    </script>
@stop