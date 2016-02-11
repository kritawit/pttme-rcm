<?php $header = 0; ?>
@if(!empty($complex_color))
<table border="1" style="width:100%" width="100%">
<thead align="center">
<tr>
  <th colspan="7" style="text-align:center;background-color:cyan;">Likelihood</th>
</tr>
<tr>
  <th></th>
  <th></th>
  @foreach($color_header as $header)
    <th style="text-align:center;">{{$header->description}}</th>
  @endforeach
</tr>
</thead>
<tboby>
<?php $i = 0; ?>
    @foreach ($color_rows as $rows_conseq)
    <?php $i++; ?>
    <tr>
        @if($i ==1)
          <td rowspan="10" style="transform: rotate(-90deg);">Consequence</td>
        @endif
        <td width="5%" align="center">{{$rows_conseq->description}}</td>
        @foreach ($complex_color as $conseq)
            @if ($conseq->rows == $rows_conseq->rows)
                <td class="cell2" width="15%" style="height: 40px;" onclick="opencolor({{$conseq->id}},{{$conseq->complex_id}},'{{$conseq->description}}','{{$conseq->ref1}}')" bgcolor="{{$conseq->description}}">{{$conseq->ref1}}</td>
            @endif
        @endforeach
    <tr>
    @endforeach
</tboby>
</table>
@endif