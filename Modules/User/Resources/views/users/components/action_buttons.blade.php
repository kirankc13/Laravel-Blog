<a href="{{ route($data['base_route'].'.show',$user->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>                                
@can($data['base_role'].'-edit')
<a href="{{ route($data['base_route'].'.edit',$user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
@endcan
@can($data['base_role'].'-delete')
<a href="javascript:;" cid="{{$user->id}}" class="btn btn-sm btn-danger delete-{{$data['name']}}"><i class="fa fa-trash-o"></i></a>
@endcan