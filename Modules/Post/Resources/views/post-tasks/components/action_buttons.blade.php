<a href="{{ route($data['base_route'].'.show',$val->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
@if(auth()->user()->can('posts-publish'))
    @if($val->task_status == 'Redo' || $val->task_status == 'Update' || $val->task_status == 'Rejected' || $val->task_status == 'Drafted' ||  $val->task_status == 'Submitted')
        @can($data['base_role'].'-edit')
            <a href="{{ route($data['base_route'].'.edit',$val->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
        @endcan
    @endif
@else
    @if($val->task_status == 'Drafted' || $val->task_status == 'Redo' || $val->task_status == 'Update')
        @can($data['base_role'].'-edit')
            <a href="{{ route($data['base_route'].'.edit',$val->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
        @endcan
    @endif
@endif
@can($data['base_role'].'-delete')
<a href="javascript:;" cid="{{$val->id}}" class="btn btn-sm btn-danger {{$data['name']}}-delete"><i class="fa fa-trash-o"></i></a>
@endcan