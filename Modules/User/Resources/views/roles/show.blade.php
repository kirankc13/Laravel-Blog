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
                <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Column</th>
                            <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Role Name</th>
                                <td>{{ $role->name  }}</td>
                            </tr>
                             <tr>
                                <th scope="row">Permissions</th>
                                <td>

                                <div class="row">
                                        @if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $name => $value)
                                        <div class="col-lg-4 checkbox-groupings">
                                        <table class="table table-bordered table-xs group-table">
                                            <thead>
                                                <tr>
                                                    <th>{{ucwords($name)}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($value as $v)
                                                <tr>
                                                    <td>
                                                        {{ $v->name }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                </td>
                            </tr>
                              <tr>
                                <th scope="row">Created At</th>
                                <td>
                                    {!! date('l M j, Y h:i A', strtotime($role->created_at)) !!} <b><i style="font-size: 12px; color: #ed1c24;">{{$role->created_at->diffForHumans()}}</i></b>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>
                                    {!! date('l M j, Y h:i A', strtotime($role->updated_at)) !!} <b><i style="font-size: 12px; color: #ed1c24;">{{$role->updated_at->diffForHumans()}}</i></b>
                                </td>
                            </tr>
                        </tbody>
                        </table>
			</div>
		</div>
	</div>

@endsection