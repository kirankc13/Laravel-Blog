<a href="{{ route($data['base_route'].'.show',$val->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>                                
@can($data['base_role'].'-delete')
<a href="javascript:;" cid="{{$val->id}}" class="btn btn-sm btn-danger {{$data['name']}}-delete"><i class="fa fa-trash-o"></i></a>
@endcan