<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Report Category (%) Unit</title>
  {!! HTML::script('public/js/jquery-1.11.2.min.js') !!}
  <script type="text/javascript">

window.onload = function () {
  $.ajax({
    url: '{{url()}}/report/chartpercentcategories',
    type: 'GET',
    dataType: 'json',
  })
  .done(function(data) {
      var chart = new CanvasJS.Chart("chartContainer",
    {
    animationEnabled: true,
    exportEnabled: true,
    title:{
      text: "Unit Chart Of (%) Equipment Category"
    },
    axisY:{
        maximum: 100,
    },
    data: [
    {
      type: "column", //change type to bar, line, area, pie, etc
      indexLabel: "{y}%",
      percentFormatString: "#0.##",
      toolTipContent: "{y}%",
      dataPoints: data
    }
    ]
    });
    chart.render();
    $(".canvasjs-chart-credit").hide();
  });

}
</script>
  {!! HTML::script('public/plugins/canvasjs/canvasjs.min.js') !!}
</head>
<body>
    <div align="center">
      <div id="chartContainer" style="height: 300px; width: 50%;" align="center"></div>
    </div>
</body>
</html>