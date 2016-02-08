<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Report Failure Effect Unit</title>
  {!! HTML::script('public/js/jquery-1.11.2.min.js') !!}
  <script type="text/javascript">
  $(document).ready(function() {
    var chart = new CanvasJS.Chart("chartContainer",
  {
    animationEnabled: true,
    exportEnabled: true,
    title:{
      text: "Unit Chart Of Failure Effect"
    },
    data: [
    {
      type: "column", //change type to bar, line, area, pie, etc
      dataPoints: <?php echo $json; ?>
    }
    ]
    });
    chart.render();
    $(".canvasjs-chart-credit").hide();
  });
</script>
  {!! HTML::script('public/plugins/canvasjs/canvasjs.min.js') !!}
</head>
<body>
    <div align="center">
      <div id="chartContainer" style="height: 300px; width: 50%;" align="center"></div>
    </div>
</body>
</html>