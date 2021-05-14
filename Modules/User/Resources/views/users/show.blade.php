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
                                <th scope="row">User Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Display Name</th>
                                <td>{{ $user->display_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">User Name</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                             <tr>
                                <th scope="row">User Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                             <tr>
                                <th scope="row">Status</th>
                                <td>{!! $user->status ? '<label class="label label-primary">Active</label>' : '<label class="label label-danger">In-active</label>' !!}</td>
                            </tr>
                             <tr>
                                <th scope="row">About</th>
                                <td>{!! $user->about ? $user->about : '<label class="label label-danger">Not Set</label>' !!}</td>
                            </tr>
                             <tr>
                                <th scope="row">Image</th>
                                <td><img src="{{ $user->image ? render($user->image) : asset('admin/img/avatar-2-64.png') }}"/></td>
                            </tr>
                            <tr>
                                <th scope="row">Roles</th>
                                <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="label label-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>
                                    {!! date('l M j, Y h:i A', strtotime($user->updated_at)) !!} <b><i style="font-size: 12px; color: #ed1c24;">{{$user->created_at->diffForHumans()}}</i></b>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>
                                    {!! date('l M j, Y h:i A', strtotime($user->updated_at)) !!} <b><i style="font-size: 12px; color: #ed1c24;">{{$user->updated_at->diffForHumans()}}</i></b>
                                </td>
                            </tr>
                        </tbody>
                        </table>
			</div>
		</div>
	</div>

@endsection