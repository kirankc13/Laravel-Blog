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
<script>
    $(document).on("click",'.publish-unpublish',function(){
        var url = $(this).data("href");
        swal({
                title: "Are you sure?",
                text: "{{setting('publish-prompt-message')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willProceed) => {
                if (willProceed) {
                    $.ajax({
                    type: "POST",
                    url: url,
                    data: {_token:"{{csrf_token()}}"},
                    success: function(data)
                    {
                        $('#ajax-messages').empty();
                        $('#ajax-messages').append(data.view);
                        $('#ajax-messages').removeAttr("hidden");
                        var table = $('#data-table').DataTable();
                        table.ajax.reload( null, false );
                    },
                    error: function(data)
                    {
                        if(data.status == 400){
                            $('#ajax-messages').empty();
                            $('#ajax-messages').append(data.responseJSON.view);
                            $('#ajax-messages').removeAttr("hidden");
                        } else if(data.status == 403){
                            var html ='<div class="alert alert-danger" role="alert"><i class="fa fa-minus-circle" aria-hidden="true"></i> Access Forbidden! This action is not authorized. Contact Administrator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            $('#ajax-messages').empty();
                            $('#ajax-messages').append(html);
                            $('#ajax-messages').removeAttr("hidden");
                        }
                    }
                });
              }
            });

        });
</script>
@endsection