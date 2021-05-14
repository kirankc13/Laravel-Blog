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
						<li class="active">{{$data['panel_name']}} Create</li>
					</ol>
				</div>
			</header>				
			<div class="box-typical box-typical-max-280 scrollable">
			<header class="box-typical-header">
				<div class="tbl-row">
					<div class="tbl-cell tbl-cell-title">
						<h3>{{$data['panel_name']}} Create </h3>
					</div>
					<div class="tbl-cell tbl-cell-action">
					<a href="{{route($data['base_route'].'.index')}}" class="btn btn-sm btn-success back-buttton"><i aria-hidden="true" class="fa fa-undo"></i> Back to {{$data['panel_name']}} List
					</a>
					</div>
				</div>
			</header>
			<div class="card-block">
			@include('admin.components.messages')
				<div class="alert alert-twitter alert-close alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<i class="font-icon font-icon-question"></i>
					<strong>How to Use</strong><br>
					You can get the value of each setting anywhere on the  site by calling <code>setting('key')</code>
				</div>
				{!! Form::open(array('route' => $data['base_route'].'.store','method'=>'POST','id'=>'validate-form')) !!}
					@include($base_view.'.components.form')
				{!! Form::close() !!}
			</div>			
		</div>
	</div> 
 
@endsection