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
        @can('categories-order')
            <div class="alert alert-twitter alert-close alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="font-icon font-icon-question"></i>
                <strong>Quick Info</strong><br>
                Drag and drop the table rows to sort them in order.
            </div>
        @endcan
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
@can('categories-order')
<script>
      $(document).ready(function () {
            function fixWidthHelper(e, ui) {
                ui.children().each(function () {
                    $(this).width($(this).width());
                });
                return ui;
            }

             $( "table tbody" ).sortable({
                items: "tr",
                cursor: 'move',
                helper: fixWidthHelper,
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });


        function sendOrderToServer() {
          var order = [];
          var token = "{{csrf_token()}}";
          $('.sortable-id').each(function(index,element) {
            order.push({
              id: $(this).val(),
              position: index+1
            });
          });

          $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route($data['base_route'].'.order_by')}}",
                data: {
              order: order,
              _token: token
            },
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
</script>
@endcan
@endsection