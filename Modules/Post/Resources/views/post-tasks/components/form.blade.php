@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/tokenfield/tokenfield.css')}}">
    <link rel="stylesheet" href="{{asset('admin/bootstrap-select/select.css')}}">
    <style>
        .publish-post-params{
            border: 1px solid #adb7be;
            padding: 18px 16px 18px 16px;
            margin-bottom: 10px;
        }
        .child-category{
                margin-left: 15px;
                margin-top: 8px;
        }
        .category-wrapper{
            border: 1px solid #adb7be;
            padding: 18px 16px 18px 16px;
            margin-bottom: 10px;
        }
        .upload-item {
            position: relative;
            width: 50%;
        }

        .middle-overlay {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .upload-item:hover .image {
            opacity: 0.3;
        }

        .upload-item:hover .middle-overlay {
            opacity: 1;
        }
    </style>
@endsection
<div class="row">
    <div class="col-md-8 col-lg-9 col-xs-12">
    <input type="hidden" name="action" id="action" value=""/>
<div class="col-xs-12 col-sm-12 col-md-12">
    @if(isset($post))
    <fieldset class="form-group">
            <label class="form-label semibold" for="roles">Related Tags*<span class="hint-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{setting('info-message-related-topics')}}">?</span></label>
            <select name="related_tags[]" class="form-control select2" multiple id="related_topics">
            @foreach($related_tags as $r)
                <option value="{{$r->id}}" {{in_array($r->id,$post_topics) ? 'selected' : ''}}>{{$r->name}}</option>
            @endforeach
            </select>
            <small class="text-muted">Psst! If you can't find related tags try adding a new one. Save changes before proceeding <a href="{{route('tags.create')}}" class="btn btn-primary btn-sm ladda-button"><i class="fa fa-plus"></i> Add New Tag</a></small>
    </fieldset>
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="related_topics">Related Tags*<span class="hint-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{setting('info-message-related-topics')}}">?</span></label>
        {!! Form::select('related_tags[]', $related_tags,[], array('class' => 'form-control select2','multiple','id'=>'related_topics')) !!}
        <small class="text-muted">Psst! If you can't find related topic try adding a new one. Save changes before proceeding <a href="{{route('tags.create')}}" class="btn btn-primary btn-sm ladda-button"><i class="fa fa-plus"></i> Add New Tags</a></small>
    </fieldset>
    @endif
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Title*</label>
        {!! Form::text('title', null, array('placeholder' => 'Title','id'=>'title','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @if(isset($post))
    @if($published)
    @can('posts-slug-editing')
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Slug*</label>
        {!! Form::text('slug', $post->slug, array('placeholder' => 'Slug','id'=>'key','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]",'disabled','value' => $post->slug)) !!}
        <div class="checkbox-bird enable-editing-div">
            <input type="checkbox" class="enable-editing" value="1" id="enable-editing">
            <label for="enable-editing">Edit Slug</label>
        </div>
    </fieldset>
    @endcan
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Slug*</label>
        {!! Form::text('slug', $post->slug, array('placeholder' => 'Slug','id'=>'key','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]",'disabled','value' => $post->slug)) !!}
        <div class="checkbox-bird enable-editing-div">
            <input type="checkbox" class="enable-editing" value="1" id="enable-editing">
            <label for="enable-editing">Edit Slug</label>
        </div>
    </fieldset>
    @endif
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="slug">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'slug','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @endif
    <fieldset class="form-group">
        <label class="form-label semibold" for="sub_title">Sub Title</label>
        {!! Form::text('sub_title', null, array('placeholder' => 'Sub Title','id'=>'sub_title','class' => 'form-control')) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="meta_title">Meta Title*</label>
        {!! Form::text('meta_title', null, array('placeholder' => 'Meta Title','id'=>'meta_title','class' => 'form-control')) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="meta_desc">Meta Description*</label>
        {!! Form::textarea('meta_desc', null, array('placeholder' => 'Meta Description','id'=>'meta_desc','class' => 'form-control','rows' => 3)) !!}
    </fieldset>
	<fieldset class="form-group">
        <label class="form-label semibold" for="summary">Summary*</label>
        {!! Form::textarea('summary', null, array('placeholder' => 'Summary','id'=>'summary','class' => 'form-control','rows' => 3,)) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="description">Description*</label>
        {!! Form::textarea('description', null, array('placeholder' => 'Description','rows'=>'4','id'=>'description','class' => 'form-control','rows' => 3)) !!}
    </fieldset>
</div>
    </div>
    <div class="col-md-4 col-lg-3 col-xs-12">
    <fieldset class="form-group">
    <label class="form-label semibold" for="status">Choose Category*</label>
    <div class="category-wrapper">
    @if(isset($post))
    @if(count($categories) > 0)
        @foreach($categories as $parent)
             <div class="checkbox-bird">
             <input type="radio" name="category" value="{{$parent->id}}" data-validation="[NOTEMPTY]" id="{{$parent->slug}}" {{$post->category_id == $parent->id ? 'checked' : ''}}>
                <label for="{{$parent->slug}}">{{$parent->title}}</label>
                @if($parent->children->count())
                @foreach($parent->children as $child)
                <div class="checkbox-bird child-category">
                <input type="radio" name="category" value="{{$child->id}}" data-validation="[NOTEMPTY]" id="{{$child->slug}}" {{$post->category_id == $child->id ? 'checked' : ''}}>
                    <label for="{{$child->slug}}">{{$child->title}}</label>
                </div>
                @endforeach
                @endif
            </div>
        @endforeach
        @else
            <span><i class="glyphicon glyphicon-exclamation-sign"></i> No Categories added</span>
        @endif
    @else
        @if(count($categories) > 0)
        @foreach($categories as $parent)
            <div class="checkbox-bird">
            {!! Form::radio('category', $parent->id, false,array('data-validation'=>"[NOTEMPTY]",'id'=>$parent->slug)) !!}
                <label for="{{$parent->slug}}">{{$parent->title}}</label>
                @if($parent->children->count())
                @foreach($parent->children as $child)
                <div class="checkbox-bird child-category">
                    {!! Form::radio('category', $child->id, false,array('data-validation'=>"[NOTEMPTY]",'id'=>$child->slug)) !!}
                    <label for="{{$child->slug}}">{{$child->title}}</label>
                </div>
                @endforeach
                @endif
            </div>
        @endforeach
        @else
            <span><i class="glyphicon glyphicon-exclamation-sign"></i> No Categories added</span>
        @endif
    @endif
    </div>
    </fieldset>
    <fieldset class="form-group">
		<label class="form-label semibold" for="image">Featured Image*<span class="hint-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{setting('info-message-featured-image')}}">?</span></label>
		 <div class="uploading-container-left" style="position:relative;">
			<div class="drop-zone" id="drop-zone-image">
				<i class="font-icon font-icon-cloud-upload-2"></i>
				<div class="drop-zone-caption">Upload Image</div>
				<span style="padding: 3px 11px;border-top-width: 0px;" class="btn btn-rounded btn-file">
					<span style="font-size:11px;">Choose file</span>
					<input type="file" class="image_input" id="image" data-id="image" name="featured_image">
				</span>
			</div>
            @if(isset($post))
			<div class="upload-item responsive d-flex justify-content-between" {{$post->featured_image == null ? 'hidden' : ''}} id="image-input-container">
				<img class="image-preview img-responsive" id="image-input" src="{{$post->featured_image != null ? render($post->featured_image) : ''}}"/>
                  <div class="middle-overlay">
                    <div class="text-overlay">
                        <button class="btn btn-sm btm-primary" id="show-featured-image">View<button>
                    </div>
                </div>
			</div>
            @else
            <div class="upload-item responsive" hidden id="image-input-container">
				<span class="close remove-image"  id="close-image-preview">x</span>
				<img class="image-preview img-responsive" id="image-input" src=""/>
                  <div class="middle-overlay">
                    <div class="text-overlay">
                        <button class="btn btn-sm btm-primary" id="show-featured-image">View<button>
                    </div>
                </div>
			</div>
            @endif
		</div>
	</fieldset>
    @can('posts-publish')
    <fieldset class="form-group">
    <label class="form-label semibold" for="publish">Publish Post?</label>
        <div class="checkbox" id="publish">
        {!! Form::checkbox('publish_post', null, false,array('onchange'=>"publishToggle()",'id'=>'publish_post')) !!}
            <label for="publish_post">Tick this box if you want to publish the post</label>
        </div>
    </fieldset>

    <div class="publish-post-params" id="publish-post-params">
        <fieldset class="form-group">
        <label class="form-label semibold" for="featured">Feature Post?*</label>
            <div class="checkbox-slide">
            @if(isset($post))
                {!! Form::checkbox('featured', true, $post->featured,array('id'=>'featured')); !!}
            @else
                {!! Form::checkbox('featured', true, false,array('id'=>'featured')); !!}
            @endif
                <label for="featured"></label>
            </div>
        </fieldset>
        <fieldset class="form-group">
        <label class="form-label semibold" for="status">Status*</label>
            <div class="checkbox-slide">
            @if(isset($post))
                {!! Form::checkbox('status', true, $post->status,array('id'=>'status')); !!}
            @else
                {!! Form::checkbox('status', true, false,array('id'=>'status')); !!}
            @endif
                <label for="status"></label>
            </div>
        </fieldset>

        <fieldset class="form-group">
        <label class="form-label semibold" for="published">Publish?*</label>
            <div class="checkbox-slide">
            @if(isset($post))
                {!! Form::checkbox('published', true, $post->published,array('id'=>'published')); !!}
            @else
                {!! Form::checkbox('published', true, false,array('id'=>'published')); !!}
            @endif
                <label for="published"></label>
            </div>
        </fieldset>
    </div>
    @endcan
    @if(isset($post))
    <div class="alert alert-info" role="alert">
        <strong>Preview Content</strong><br>
        Preview the content before submitting. For changes to reflect save changes before previewing.
        <a href="{{route('preview',$post)}}" class="btn btn-sm btn-primary" target="_blank">Show Preview</a>
    </div>
    @else
    <div class="alert alert-info" role="alert">
        <strong>Preview Content</strong><br>
        In order to preview content you need to save changes.
    </div>
    @endif
    <hr>
    @if(isset($post))
        @if(auth()->user()->can('posts-publish'))
         <div class="action-group">
            <button type="submit" id="save_as_draft" class="btn btn-md btn-success"">Save changes</button>
            <button type="submit" id="submitButton" class="btn btn-md btn-primary">Submit</button>
            @if($post->task_status == 'Submitted' || $post->task_status == 'Rejected')
            <button type="submit" id="redoButton" class="btn btn-md btn-warning">Redo</button>
            @endif
            @if($post->task_status == 'Submitted')
            <button type="submit" id="rejectButton" class="btn btn-md btn-danger">Reject</button>
            @endif
        </div>
        @else
           @if($post->task_status == 'Drafted' || $post->task_status == 'Redo' || $post->task_status == 'Update')
            <div class="action-group">
                <button type="submit" id="save_as_draft" class="btn btn-md btn-success"">Save changes</button>
                <button type="submit" id="submitButton" class="btn btn-md btn-primary">Submit</button>
            </div>
        @endif
        @endif
    @else
        <div class="action-group">
            <button type="submit" id="save_as_draft" class="btn btn-md btn-success"">Save changes</button>
            <button type="submit" id="submitButton" class="btn btn-md btn-primary">Submit</button>
        </div>
    @endif
    </div>
</div>
<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="view-image">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close btn btn-primary btn-rounded btn-sm" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel">Viewing Featured Image</h4>
            </div>
            <div class="modal-body">
                <div>
                    <img  style="display: block;margin: 0 auto;" src="" id="featured_image_modal" class="img-fluid"/>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script src="{{asset('admin/ckeditor-3/ckeditor.js')}}"></script>
<script src="{{asset('admin/bootstrap-select/select.js')}}"></script>
<script src="{{asset('admin/tokenfield/tokenfield.js')}}"></script>
@can('posts-publish')
<script>
    $(window).load(function(){
        if($('#publish_post').is(":checked")){
            $('#published').prop('checked', true);
        }else{
            $('.publish-post-params').hide();
        }
    });
</script>
@endcan
<script>
	@if(isset($post))
	$("#title").blur(function (e) {
		var isDisabled = $('.unique-editing').prop('disabled');
		if (!isDisabled) {
			$('#title').val($.trim($('#title').val()));
			var title = $('#title').val();
			var forSuggestTitle = title;
			title = title.toLowerCase();
			title = title.trim();
			var shortwords = /\b()\b/g;
			title = title.replace(shortwords, function (fullmatch, badword) {
				return new Array(badword.length + 1).join('');
			});
			title = title.replace(/[^a-zA-Z0-9]/g, '-');
			title = title.replace(/(-){2,}/g, '-');
			title = title.replace(/-$/g, '');
			title = title.replace(/(^\s*-)|(,\s*$)/g, '');
					$(".unique-editing").val(title);
				}
			});

		$(".enable-editing").on('change',function () {
			if($('.unique-editing').attr("disabled")){
                $('.unique-editing').removeAttr("hidden");
				$('.unique-editing').removeAttr("disabled");
			}else{
				$('.unique-editing').attr("disabled",true);
			}
		});
		@else
		$("#title").blur(function (e) {
			$(this).val($.trim($(this).val()));
			var title = $(this).val();
			var forSuggestTitle = title;
			title = title.toLowerCase();
			title = title.trim();
			var shortwords = /\b()\b/g;
			title = title.replace(shortwords, function (fullmatch, badword) {
				return new Array(badword.length + 1).join('');
			});
			title = title.replace(/[^a-zA-Z0-9]/g, '-');
			title = title.replace(/(-){2,}/g, '-');
			title = title.replace(/-$/g, '');
			title = title.replace(/(^\s*-)|(,\s*$)/g, '');
			$("#slug").val(title);
		});
		@endif

		function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-input-container').removeAttr("hidden");
                $('#image-input').attr('src', e.target.result);
                $('#close-image-preview').removeAttr("hidden");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image_input").change(function() {
        var id = $(this).attr("data-id");
        readURL(this,id);
    });

    $('#show-featured-image').click(function(){
        var src = $('#image-input').attr("src");
        $('#featured_image_modal').attr("src",src);
        $('#view-image').modal('show');
    });

    @if(!isset($post))
    $('.remove-image').click(function(){
        var key = $(this).attr("cid");
        $('#image').val('');
        $('#image-input-container').attr("hidden","true");
    });
    @endif
    $(document).on("keydown", ":input:not(textarea)", function(event) {
        return event.key != "Enter";
    });

    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('editor.upload_image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].on('change', function ()
        {
            var editorName = $(this)[0].name;
            CKEDITOR.instances[editorName].updateElement();
        });
    }

    function publishToggle()
    {
        if($('#publish_post').is(":checked")){
            $(".publish-post-params").fadeIn( "fast" );
        }else{
            $(".publish-post-params").hide();
        }
    }

    $('#save_as_draft').click(function(){
        $('#action').val('save_as_draft');

    });
    $('#submitButton').click(function(){
        $('#action').val('submit');
    });
    $('#redoButton').click(function(){
        $('#action').val('redo');
    });
    $('#rejectButton').click(function(){
        $('#action').val('reject');
    });
    $('input[name=tags]').tokenfield();
    @if(isset($_COOKIE['dark_mode']))
        CKEDITOR.addCss('.cke_editable { background-color: black; color: white }');
    @else
        CKEDITOR.addCss('.cke_editable { background-color: white; color: black }');
    @endif

    $(document.body).on("change","#related_topics",function(){
        var ids = $(this).val();
    });

</script>
@endsection


