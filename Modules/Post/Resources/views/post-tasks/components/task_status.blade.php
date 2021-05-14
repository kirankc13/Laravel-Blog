@if(auth()->user()->can('posts-publish'))
    @if($val->task_status == "Drafted")
        <span class="label label-pill label-primary"><i class="glyphicon glyphicon-pencil"></i> Drafted</span>
    @elseif($val->task_status == "Update")
        <span class="label label-pill label-warning"><i class="font-icon font-icon-refresh"></i> Update</span>
    @elseif($val->task_status == "Published")
        <button class="btn btn-sm btn-success toggle-task-status" data-id="{{$val->id}}"><i class="font-icon font-icon-check-circle"></i> Published <i hidden id="data-table-task-status-loader-{{$val->id}}" class="fa fa-spinner fa-spin fa-fw"></i></button>
    @elseif($val->task_status == "Redo")
        <button class="btn btn-sm btn-warning toggle-task-status" data-id="{{$val->id}}"><i class="glyphicon glyphicon-repeat"></i> Redo <i hidden id="data-table-task-status-loader-{{$val->id}}" class="fa fa-spinner fa-spin fa-fw"></i></button>
    @elseif($val->task_status == "Rejected")
        <button class="btn btn-sm btn-danger toggle-task-status" data-id="{{$val->id}}"><i class="glyphicon glyphicon-exclamation-sign"></i> Rejected <i hidden id="data-table-task-status-loader-{{$val->id}}" class="fa fa-spinner fa-spin fa-fw"></i></button>
    @elseif($val->task_status == "Submitted")
        <button class="btn btn-sm btn-info toggle-task-status" data-id="{{$val->id}}"><i class="font-icon font-icon-answer"></i> Submitted <i hidden id="data-table-task-status-loader-{{$val->id}}" class="fa fa-spinner fa-spin fa-fw"></i></button>
    @endif
@else
@if($val->task_status == "Drafted")
    <span class="label label-pill label-primary"><i class="glyphicon glyphicon-pencil"></i> Drafted</span>
    @elseif($val->task_status == "Published")
        <span class="label label-pill label-success"><i class="font-icon font-icon-check-circle"></i> Published</span>
    @elseif($val->task_status == "Redo")
        <span class="label label-pill label-warning"><i class="glyphicon glyphicon-repeat"></i> Redo</span>
    @elseif($val->task_status == "Rejected")
        <span class="label label-pill label-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> Rejected</span>
    @elseif($val->task_status == "Submitted")
        <span class="label label-pill label-info"><i class="font-icon font-icon-answer"></i> Submitted</span>
    @elseif($val->task_status == "Update")
        <span class="label label-pill label-warning"><i class="font-icon font-icon-refresh"></i> Update</span>
    @endif
@endif
