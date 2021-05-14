<div class="modal fade activity-log in" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="modal-close btn btn-primary btn-rounded btn-sm" data-dismiss="modal" aria-label="Close">
             <i class="font-icon-close-2"></i>
             </button>
             <h4 class="modal-title" id="myModalLabel">Activity Log</h4>
          </div>
          <div class="modal-body">
            @if(count($log_data) > 0)
             <div class="box-typical box-typical-max-280 scrollable">
                <table id="log" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                   <thead>
                      <tr>
                         <th>Log</th>
                         <th>Caused By</th>
                         <th>Created At</th>
                         <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach($log_data as $l)
                      <tr>
                         <td>{{$l->description}}</td>
                         <td>{{$l->user_name}}</td>
                         <td><span class="label label-pill label-primary">{{date_format($l->created_at,'F d, Y g:i A')}}</span></td>
                         <td><a href="{{route('post-tasks.activity_show',['id' => $post->id,'log_id' => $l->id])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                      </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
             @else
             <div class="text-center">
                <h4>No Records Found</h4>
            </div>
            @endif
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
          </div>
       </div>
    </div>
 </div>