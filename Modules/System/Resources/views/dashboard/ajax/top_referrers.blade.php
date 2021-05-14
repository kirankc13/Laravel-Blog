<div class="box-typical-body panel-body">
	<table class="tbl-typical">
		<tr>
			<th><div>URL</div></th>
			<th><div>Page Views</div></th>
		</tr>
		@if(count($data) > 0)
		@foreach($data as $d)
		<tr>
			<td>{{$d['url']}}</td>
			<td><span class="label label-primary">{{$d['pageViews']}}</span></td>
		</tr>
		@endforeach
		@else
		<div class="text-center" style="padding:20px;">
			<h4>No records Found</h4>
		</div>
		@endif
	</table>
</div>