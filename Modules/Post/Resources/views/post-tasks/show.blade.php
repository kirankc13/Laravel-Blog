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
                        <a href="{{route($data['base_route'].'.index')}}" class="btn btn-sm btn-success" style="float:right;"><i aria-hidden="true" class="fa fa-undo"></i> Back to {{$data['panel_name']}} List
                        </a>
						@can('posts-view-task-logs')
                        <button id="reload" class="btn btn-sm btn-primary datatable-refresh-button" data-toggle="modal" data-target=".activity-log"><i aria-hidden="true" class="font-icon font-icon-zigzag"></i> View Task Log
                        </button>
						@endcan
					</div>
				</div>
			</header>
			<div class="card-block">
				@foreach($rows as $key => $value)
				<fieldset class="form-group">
					<label class="form-label"><strong>{{ucwords(str_replace('_', ' ', $key))}}</strong></label>
					<span>{!! $value ? $value : '<span class="label label-danger">Not Set</span>'!!}</span>
				</fieldset>
				<hr style="border-top-color: #d8e2e7;margin: 1em 0;">
				@endforeach
			</div>
		</div>
        @include($base_view.'.components.task_log')
	</div>

@endsection