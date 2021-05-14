<a href="{{ route('roles.show',$val->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>                                
@can('role-edit')
<a href="{{ route('roles.edit',$val->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
@endcan
@can('role-delete')
<a href="javascript:;" cid="{{$val->id}}" class="btn btn-sm btn-danger delete-role"><i class="fa fa-trash-o"></i></a>
@endcan    
