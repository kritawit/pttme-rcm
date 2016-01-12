@if (!empty($picture->picture_path))
	{!! HTML::image(url().'/public/images/level/'.$picture->level.'/'.$picture->picture_path, null, array('width'=>'260','height'=>'150')) !!}
	<br>
@endif