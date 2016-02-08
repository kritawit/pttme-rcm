<?php $header = 0; ?>
@if(!empty($complex_color))
<table border="1" style="width:100%">
<thead align="center">
<tr>
  <th></th>
  @foreach($color_header as $header)
    <th style="text-align:center;">{{$header->description}}</th>
  @endforeach
</tr>
</thead>
<tboby>
    @foreach ($color_rows as $rows_conseq)
    <tr>
        <td width="5%" align="center">{{$rows_conseq->description}}</td>
        @foreach ($complex_color as $conseq)
            @if ($conseq->rows == $rows_conseq->rows)
                <td class="cell2" width="60" onclick="opencolor({{$conseq->id}},{{$conseq->complex_id}},'{{$conseq->description}}','{{$conseq->ref1}}')" bgcolor="{{$conseq->description}}">{{$conseq->ref1}}</td>
            @endif
        @endforeach
    <tr>
    @endforeach
</tboby>
</table>
@endif