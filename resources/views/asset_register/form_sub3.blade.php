<h4>Complex Detail</h4>
<legend></legend>
<form action="" method="POST" class="form-horizontal" role="form">
    <div class="form-group">
      <label class="col-lg-2 control-label">Complex : </label>
      <div class="col-lg-4">
        <select class="form-control select2">
          <option value="">4 x 4</option>
          <option value="">4 x 4</option>
          <option value="">4 x 4</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Data : </label>
      <div class="col-lg-6">
          <div class="radio">
          <label>
            <input type="radio" name="check" id="input" value="">
            Defualt
          </label>
          <label>
            <input type="radio" name="check" id="input" value="">
            Custom
          </label>
          </div>
      </div>
    </div>
</form>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th></th>
      <th>1-20</th>
      <th>21-40</th>
      <th>41-60</th>
      <th>61-80</th>
    </tr>
  </thead>
  <tbody>
    <tr align="center">
      <td>2</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr align="center">
      <td>4</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr align="center">
      <td>6</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr align="center">
      <td>8</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<script type="text/javascript">
  $(function() {
    $(".select2").select2();
  });
</script>