@extends('admin.layouts.master')
@section('content')
	<div class="page-content">
		<div class="container-fluid">
        <header class="section-header">
				<div class="tbl">
					<h3>{!!$data['icon']!!} {{$data['panel_name']}}</h3>
					<ol class="breadcrumb breadcrumb-simple">
						<li><a href="{{URL::to('/')}}">Dashboard</a></li>
                        <li><a href="{{route($data['base_route'].'.index')}}">{{$data['panel_name']}}</a></li>
						<li class="active">{{$data['panel_name']}} View</li>
					</ol>
				</div>
			</header>
			<div class="box-typical box-typical-max-280 scrollable">
			<header class="box-typical-header">
				<div class="tbl-row">
					<div class="tbl-cell tbl-cell-title">
						<h3>{{$data['panel_name']}} View</h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
					<a href="{{route($data['base_route'].'.index')}}" class="btn btn-sm btn-success back-buttton"><i aria-hidden="true" class="fa fa-undo"></i> Back to {{$data['panel_name']}} List
					</a>
					</div>
				</div>
			</header>
			<div class="card-block">
            <header class="box-typical-header">
				<div class="tbl-row">
					<div class="tbl-cell tbl-cell-title" style="padding:5px;">
						<h3>Log Activity</h3>
					</div>
				</div>
			</header>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Column</th>
                        <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
						<tr>
							<th scope="row">Activity</th>
							<td>{{$log_data->description}}</td>
						</tr>
						<tr>
							<th scope="row">Entity</th>
							<td>{{$log_data->log_name}}</td>
						</tr>
						<tr>
							<th scope="row">Caused By</th>
							<td>{{$log_data->causer->name}}</td>
						</tr>
						<tr>
							<th scope="row">Activity Time</th>
							<td>{{date('l M j, Y h:i:s A', strtotime($log_data->created_at))}}</td>
						</tr>

                    </tbody>
                </table>
			</div>
            @if(isset($log['old']))
			<div class="card-block">
            <header class="box-typical-header">
				<div class="tbl-row">
					<div class="tbl-cell tbl-cell-title" style="padding:5px;">
						<h3>Previous Values</h3>
					</div>
				</div>
			</header>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Column</th>
                        <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($log['attributes'] as $key => $val)
                            @include($base_view.'.components.activity_show')
                        @endforeach
                    </tbody>
                </table>
			</div>
            @endif
            @if(isset($log['attributes']))
			<div class="card-block">
            <header class="box-typical-header">
				<div class="tbl-row">
					<div class="tbl-cell tbl-cell-title" style="padding:5px;">
						<h3>Current Values</h3>
					</div>
				</div>
			</header>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Column</th>
                        <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($log['attributes'] as $key => $val)
                            @include($base_view.'.components.activity_show')
                        @endforeach
                    </tbody>
                </table>
			</div>
            @endif
		</div>
	</div>
@endsection