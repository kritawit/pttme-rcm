<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Informations</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
  <div class="box-body" >
    <form action="{{url()}}/asset-register/saveformlevel" id="frmOther" method="POST" class="form-horizontal" role="form" >
            <div class="row">
              <div class="col-lg-6">
              <div class="form-group">
              <label for="" class="control-label col-lg-4">{{ $assets->level_desc}}:</label>
              <div class="col-lg-8">
                <input type="hidden" name="node_id"  value="{{ $assets->id}}" required class="form-control" >
                <input type="text" name="asset_name" value="{{ $assets->asset_name}}"  required class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-4">Description : </label>
              <div class="col-lg-8">
                <textarea name="description" id="description" required class="form-control" cols="25" rows="3">{{ $assets->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-lg-4">Create Date</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->created_at}}" readonly  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Create By</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->create_name}}" readonly  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Update Date</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->updated_at}}" readonly  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Update By</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->update_name}}" readonly   class="form-control">
                </div>
              </div>
              <div class="form-group">
        <div class="col-lg-4"></div>
        <div class="col-lg-8">
          <button type="button" onclick="saveformlevel();" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
          <div>
            <div class="form-group">
              <div class="col-lg-12">
                <canvas id="pieChart" style="height:250px"></canvas>
              </div>
            </div>
          </div>
      </div>
      </div>
    </form>
      <hr>
      <table class="table table-hover" id="tb_unders">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($unders as $un)
          <tr>
            <td>{{$un->asset_name}}</td>
            <td>{{$un->description}}</td>
            <td>SUB ASSEMBLY</td>
          </tr>
        @endforeach
        </tbody>
      </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
{!! HTML::script('public/js/jquery.form.js') !!}
{!! HTML::script('public/plugins/chartjs/Chart.min.js') !!}
<script type="text/javascript">
  $(function() {
    $("#tb_unders").DataTable();

    $.ajax({
      url: '{{url()}}/asset-register/chartcolour',
      type: 'GET',
      dataType: 'json',
      data: {node_id: $("input[name=node_id]").val()},
      success:function(data){
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        pieChart.Doughnut(data, pieOptions);
      }
    });
  });
  function saveformlevel(){
  if (frmvalidate() == true) {
    $("#frmOther").ajaxForm({
    dataType: 'json',
    success: function(text){
      if (text[0]['message']==='success') {
        alert('save successfully.');
      }else{
        alert('save fail!');
      }
    }
    }).submit();
    }
  }
  function frmvalidate(){
  if($("input[name=asset_name]").val()==''){
    alert('{{ $assets->level_desc}} invalid!');
    $("input[name=asset_name]").focus();
    return false;
  }else if($("#description").val()==''){
    alert('Description invalid!');
    $("#description").focus();
    return false;
  }else{
    return true;
  }
}
</script>