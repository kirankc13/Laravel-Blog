@if($post->task_status == 'Published')
<div class="modal-header">
    <button type="button" class="modal-close btn btn-primary btn-rounded btn-sm" data-dismiss="modal" aria-label="Close">
        <i class="font-icon-close-2"></i>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{$post->title}} <small class="text-muted">{{$post->task_status}}</small></h4>
</div>
{!! Form::open(array('route' => 'post-tasks.send-for-update','method'=>'POST','id' => 'send-for-update')) !!}
<input type="hidden" value="{{$post->id}}" name="post_id"/>
<div class="modal-body">
    <fieldset class="form-group">
    <label class="form-label semibold" for="assign_to_same_user_div">Assign to Same User?</label>
        <div class="checkbox" id="assign_to_same_user_div">
        {!! Form::checkbox('assign_to_same_user', null, true,array('id'=>'assign_to_same_user')) !!}
            <label for="assign_to_same_user">Tick this box if you want to assign the update task for the same user</label>
        </div>
    </fieldset>
    <div id="select-update-user-div" hidden>
        <fieldset class="form-group">
            <label class="form-label semibold" for="update_user_select">User</label>
            <select class="selectpicker form-control" data-live-search="true" name="user_id" id="update_user_select">
                @foreach($user as $u)
                    <option data-tokens="{{$u->name}}" value="{{$u->id}}" {{$post->user_id == $u->id ? 'selected' : ''}}>{{$u->name}}
                        (
                            @foreach ($u->roles->pluck('name') as $item)
                                <span class="label label-primary">{{$item}}</span>
                            @endforeach
                        )
                        </option>
                @endforeach
            </select>
        </fieldset>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
    <button type="button" id="send-for-update-button" class="btn btn-rounded btn-primary">Send For Update</button>
</div>
{!! Form::close() !!}
@elseif($post->task_status == 'Redo' || $post->task_status == 'Rejected' || $post->task_status == 'Submitted')
<div class="modal-header">
    <button type="button" class="modal-close btn btn-primary btn-rounded btn-sm" data-dismiss="modal" aria-label="Close">
        <i class="font-icon-close-2"></i>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{$post->title}} <small class="text-muted">{{$post->task_status}}</small></h4>
</div>
{!! Form::open(array('route' => 'post-tasks.change-task-status','method'=>'POST','id' => 'change-task-status-form')) !!}
<div class="modal-body">
<input type="hidden" value="{{$post->id}}" name="post_id"/>
    <div>
        @if($post->task_status != 'Redo')
        <div class="checkbox-bird">
            <input class="task_status_toggle" type="radio" name="task_status" value="Redo" data-action="redo" id="task_status_redo" onchange="publishToggle('redo')">
            <label for="task_status_redo">Redo</label>
        </div>
        @endif
        @if($post->task_status != 'Rejected')
        <div class="checkbox-bird">
            <input class="task_status_toggle" type="radio" name="task_status" value="Rejected" data-action="reject" id="task_status_reject" onchange="publishToggle('reject')">
            <label for="task_status_reject">Reject</label>
        </div>
        @endif
        @if($post->task_status != 'Published')
        <div class="checkbox-bird">
            <input class="task_status_toggle" type="radio" name="task_status" value="Published" id="task_status_publish" data-action="publish" onchange="publishToggle('publish')">
            <label for="task_status_publish">Publish</label>
        </div>
        @endif
        <div hidden id="publish-attributes-for-modal">
          <div class="alert alert-purple alert-fill alert-close alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Heads Up!</strong><br>
							These parameters are reflected on the website. You can change them later, only if you have access to published posts.
						</div>
            <div class="row" style="text-align:center">
                <div class="col-md-4 col-xs-12 col-lg-4">
                    <fieldset class="form-group">
                        <label class="form-label semibold" for="featured">Feature Post?*</label>
                        <div class="checkbox-slide">
                            <input id="featured" name="featured" type="checkbox" checked value="1">
                            <label for="featured"></label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                    <fieldset class="form-group">
                        <label class="form-label semibold" for="status">Status*</label>
                        <div class="checkbox-slide">
                            <input id="status" name="status" type="checkbox" checked value="1">
                            <label for="status"></label>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-4 col-xs-12 col-lg-4">
                    <fieldset class="form-group">
                        <label class="form-label semibold" for="published">Publish?*</label>
                        <div class="checkbox-slide">
                            <input id="published" name="published" type="checkbox" checked value="1">
                            <label for="published"></label>
                        </div>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
    <button type="button" id="change-task-status-form-button" class="btn btn-rounded btn-primary">Save changes</button>
</div>
{!! Form::close() !!}
@endif

