<div class="text-center">
    @if(auth()->user()->can($data['base_role'].'-publish'))
        @if($val->published)
            <button class="btn btn-success btn-sm publish-unpublish" data-href="{{route('posts.publish',$val->id)}}"><i class="font-icon font-icon-check-circle"></i> Yes
            </button>
        @else
            <button class="btn btn-danger btn-sm publish-unpublish" data-href="{{route('posts.publish',$val->id)}}"><i class="font-icon font-icon-pencil"></i> No
            </button>
        @endif    
    @else
        @if($val->published)
            <span class="label label-pill label-success">
                <div style="padding-top:3px;">
                    <i class="font-icon font-icon-check-circle"></i> Yes
                </div>
            </span>
        @else        
            <span class="label label-pill label-danger">
                <div style="padding-top:3px;">
                    <i class="font-icon font-icon-pencil"></i> No
                </div>
            </span>
        @endif     
    @endif
</div>