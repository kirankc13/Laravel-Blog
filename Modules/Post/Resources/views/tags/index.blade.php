@extends('admin.layouts.master')
@section('data_table_css')
<link rel="stylesheet" href="{{asset('admin/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/css/separate/vendor/datatables-net.min.css')}}">
@endsection
@section('content')
<div class="page-content">
	<div class="container-fluid">
        <header class="section-header">
			<div class="tbl">
				<h3>{!!$data['icon']!!} {{$data['panel_name']}}</h3>
				<ol class="breadcrumb breadcrumb-simple">
					<li><a href="{{URL::to('/')}}">Dashboard</a></li>
					<li class="active">{{$data['panel_name']}} List</li>
				</ol>
			</div>
		</header>
        <div class="box-typical box-typical-max-280 scrollable">
        <header class="box-typical-header">
            <div class="tbl-row tbl-row-mobile">
                <div class="tbl-cell tbl-cell-title">
                    <h3>{{$data['panel_name']}} List </h3>
                </div>
                <div class="tbl-cell tbl-cell-action">
                    <a href="{{ route($data['base_route'].'.create') }}"  class="btn btn-sm btn-success" style="float: right;"><i aria-hidden="true"  class="fa fa-plus"></i> Create New {{$data['panel_name']}}
                    </a>
                    <button id="reload" class="btn btn-sm btn-secondary datatable-refresh-button"><i aria-hidden="true"  class="fa fa-refresh"></i> Refresh
                    </button>
                </div>
            </div>
        </header>
        <div class="card-block">
        @include('admin.components.messages')
            <table id="data-table" class="display table table-striped table-bordered data-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    @foreach($data['columns'] as $key => $val)
                        <th scope="col">{{$key}}</th>
                    @endforeach
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    @foreach ($data['columns'] as $key => $val)
                        <th type="{{$val['type']}}">{{$key}}</th>
                    @endforeach
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
	</div>
</div>
@endsection
@section('js')
@include('admin.components.data_table_init')
@include('admin.components.delete_script')
@endsection