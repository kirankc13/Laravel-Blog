<a href="{{ route($data['base_route'].'.show',$val->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>                                
@can($data['base_role'].'-edit')
<a href="{{ route($data['base_route'].'.edit',$val->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
@endcan
@can($data['base_role'].'-delete')
<a href="javascript:;" cid="{{$val->id}}" class="btn btn-sm btn-danger {{$data['name']}}-delete"><i class="fa fa-trash-o"></i></a>
@endcan
<input type="hidden" class="sortable-id" value="{{ $val->id }}">