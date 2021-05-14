<div class="box-typical-body panel-body">
	<table class="tbl-typical">
		<tr>
			<th><div>Page</div></th>
			<th><div>Page Views</div></th>
			<th><div>Action</div></th>
		</tr>
		@if(count($data) > 0)
		@foreach($data as $d)
		<tr>
			<td>{{$d['pageTitle']}}</td>
			<td><span class="label label-primary">{{$d['pageViews']}}</span></td>
			<td><a href="{{$d['url']}}" target="_blank" class="btn btn-sm btn-success">View</a></td>
		</tr>
		@endforeach
		@else
		<div class="text-center" style="padding:20px;">
			<h4>No records Found</h4>
		</div>
		@endif
	</table>
</div>