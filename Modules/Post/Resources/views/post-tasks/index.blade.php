@extends('admin.layouts.master')
@section('data_table_css')
<link rel="stylesheet" href="{{asset('admin/css/lib/datatables-net/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/css/separate/vendor/datatables-net.min.css')}}">
@can('posts-publish')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
@endcan
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
<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="toggle-status-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="task-status-view">

        </div>
    </div>
</div>
@endsection
@section('js')
@include('admin.components.data_table_init')
@include('admin.components.delete_script')
@can('posts-publish')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script>
    $(document).on('click','.toggle-task-status',function(){
        $('#task-status-view').attr("hidden",true);
        var id = $(this).data("id");
        $('#data-table-task-status-loader-'+id).removeAttr("hidden");
        var url = "{{route('post-tasks.get_current_task_status')}}"
        $.ajax({
            type: "GET",
            url: url,
            data: {id:id},
            success: function(data)
            {
                $('#data-table-task-status-loader-'+id).attr("hidden","true");
                $('#toggle-status-modal').modal('show');
                $('#task-status-view').removeAttr("hidden");
                $('#task-status-view').empty();
                $('#task-status-view').append(data.view);
                $('#update_user_select').selectpicker();
            },
            error: function(data)
            {
                $('#data-table-task-status-loader-'+id).attr("hidden","true");
                $('#toggle-status-modal').modal('show');
                $('#task-status-view').removeAttr("hidden");
                if(data.status == 403){
                    var html = `<div class="modal-header">
                            <button type="button" class="modal-close btn btn-primary btn-rounded btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="font-icon-close-2"></i>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">403 Access Forbidden</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert"><i class="fa fa-minus-circle" aria-hidden="true"></i> Access Forbidden! This action is not authorized. Contact Administrator.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                        </div>`;
                    $('#task-status-view').empty();
                    $('#task-status-view').append(html);
                }else if(data.status == 500){

                    var html = `<div class="modal-header">
                            <button type="button" class="modal-close btn btn-primary btn-rounded btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="font-icon-close-2"></i>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Something went wrong</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert"><i class="fa fa-minus-circle" aria-hidden="true"></i> It seems to be a server error! Contact Adminstrator</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                        </div>`;
                    $('#task-status-view').empty();
                    $('#task-status-view').append(html);
                }
            }
        });
    });

    $(document).on('click', '#assign_to_same_user', function() {
        if($(this).is(":checked")){
            $("#select-update-user-div").attr("hidden",true);
        }else{
            $("#select-update-user-div").removeAttr("hidden");
        }
    });

    function publishToggle(status)
    {
        var status = status;
        if($('.task_status_toggle').is(":checked")){
            if(status == 'publish'){
                $("#publish-attributes-for-modal").removeAttr("hidden");
            }else{
                $("#publish-attributes-for-modal").attr("hidden",true);
            }
        }
    }

     $(document).on('click', '#send-for-update-button', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');;
        var url = form.attr('action');
         swal({
            title: "Are you sure?",
            text: "Are you sure you want to proceed with this action?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willProceed) => {
            if (willProceed) {
                 $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data)
                    {
                        $('#toggle-status-modal').modal('toggle');
                        $('#ajax-messages').empty();
                        $('#ajax-messages').append(data.view);
                        $('#ajax-messages').removeAttr("hidden");
                        var table = $('#data-table').DataTable();
                        table.ajax.reload( null, false );
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    },
                    error: function(data)
                    {
                        if(data.status == 400){
                            $('#toggle-status-modal').modal('toggle');
                            $('#ajax-messages').empty();
                            $('#ajax-messages').append(data.responseJSON.view);
                            $('#ajax-messages').removeAttr("hidden");
                        } else if(data.status == 403){
                            var html ='<div class="alert alert-danger" role="alert"><i class="fa fa-minus-circle" aria-hidden="true"></i> Access Forbidden! This action is not authorized. Contact Administrator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            $('#toggle-status-modal').modal('toggle');
                            $('#ajax-messages').empty();
                            $('#ajax-messages').append(html);
                            $('#ajax-messages').removeAttr("hidden");
                        }
                        $("html, body").animate({ scrollTop: 0 }, "fast");

                    }
                });
            }
        });
    });

    $(document).on('click', '#change-task-status-form-button', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var url = form.attr('action');
         swal({
            title: "Are you sure?",
            text: "Are you sure you want to proceed with this action?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willProceed) => {
            if (willProceed) {
                    $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(data)
                    {
                        $('#toggle-status-modal').modal('toggle');
                        $('#ajax-messages').empty();
                        $('#ajax-messages').append(data.view);
                        $('#ajax-messages').removeAttr("hidden");
                        var table = $('#data-table').DataTable();
                        table.ajax.reload( null, false );
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    },
                    error: function(data)
                    {
                        if(data.status == 400){
                            $('#toggle-status-modal').modal('toggle');
                            $('#ajax-messages').empty();
                            $('#ajax-messages').append(data.responseJSON.view);
                            $('#ajax-messages').removeAttr("hidden");
                        } else if(data.status == 403){
                            var html ='<div class="alert alert-danger" role="alert"><i class="fa fa-minus-circle" aria-hidden="true"></i> Access Forbidden! This action is not authorized. Contact Administrator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            $('#toggle-status-modal').modal('toggle');
                            $('#ajax-messages').empty();
                            $('#ajax-messages').append(html);
                            $('#ajax-messages').removeAttr("hidden");
                        }
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }
                });
            }
        });

});

</script>

@endcan
@endsection

