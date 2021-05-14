@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <style>
        /*! CSS Used from: https://stories.botble.com/vendor/core/core/base/css/core.css ; media=all */
@media all{
*,:after,:before{box-sizing:border-box;}
hr{box-sizing:content-box;height:0;overflow:visible;}
p{margin-top:0;margin-bottom:1rem;}
small{font-size:80%;}
a{text-decoration:none;background-color:transparent;}
a:hover{text-decoration:underline;}
label{display:inline-block;margin-bottom:.5rem;}
input,textarea{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
input{overflow:visible;}
textarea{overflow:auto;resize:vertical;}
hr{margin-top:1rem;margin-bottom:1rem;border-top:1px solid rgba(0,0,0,.1);}
small{font-size:80%;font-weight:400;}
.form-control{display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.form-control{transition:none;}
}
.form-control::-ms-expand{background-color:transparent;border:0;}
.form-control:-moz-focusring{color:transparent;text-shadow:0 0 0 #495057;}
.form-control:focus{color:#495057;background-color:#fff;border-color:#80bdff;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25);}
.form-control::-moz-placeholder{color:#6c757d;opacity:1;}
.form-control:-ms-input-placeholder{color:#6c757d;opacity:1;}
.form-control::placeholder{color:#6c757d;opacity:1;}
.form-control:disabled{background-color:#e9ecef;opacity:1;}
textarea.form-control{height:auto;}
.form-group{margin-bottom:1rem;}
.form-control.is-valid{border-color:#28a745;padding-right:calc(1.5em + .75rem);background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right calc(.375em + .1875rem) center;background-size:calc(.75em + .375rem) calc(.75em + .375rem);}
.form-control.is-valid:focus{border-color:#28a745;box-shadow:0 0 0 .2rem rgba(40,167,69,.25);}
textarea.form-control.is-valid{padding-right:calc(1.5em + .75rem);background-position:top calc(.375em + .1875rem) right calc(.375em + .1875rem);}
@media print{
*,:after,:before{text-shadow:none!important;box-shadow:none!important;}
a:not(.btn){text-decoration:underline;}
p{orphans:3;widows:3;}
}
a:hover{cursor:pointer;}
label{font-weight:400;}
a{color:#007bff;}
a:hover{color:#0056b3;}
a:active,a:focus,a:hover{outline:0;}
hr{margin:20px 0;border:0;border-top:1px solid #eee;border-bottom:0;}
.hidden{display:none!important;}
.control-label{margin-top:1px;font-weight:400;}
.form-control{outline:0!important;box-shadow:none!important;}
a{text-shadow:none;color:#337ab7;}
.ws-nm{white-space:normal;}
.form-control{font-size:.9rem;}
}
/*! CSS Used from: https://stories.botble.com/vendor/core/packages/seo-helper/css/seo-helper.css ; media=all */
@media all{
#seo_wrap .btn-trigger-show-seo-detail{position:absolute;top:8px;right:20px;text-decoration:none!important;}
#seo_wrap .seo-preview{margin-bottom:20px;}
#seo_wrap .seo-preview *{word-break:break-all;}
#seo_wrap .seo-preview .page-title-seo{min-height:21px;display:block;font-size:18px;color:#1a0dab;line-height:21px;margin-bottom:2px;text-overflow:ellipsis;overflow:hidden;}
#seo_wrap .seo-preview .page-url-seo p{display:block;word-wrap:break-word;color:#006621;font-size:13px;line-height:16px;margin-bottom:2px;}
}
/*! CSS Used from: https://stories.botble.com/vendor/core/core/base/css/themes/default.css ; media=all */
@media all{
.widget-body{padding:15px;border-radius:0 0 3px 3px;min-height:200px;}
.meta-boxes .widget-body{min-height:0;}
.form-group{position:relative;}
small.charcounter{position:absolute;top:0;right:0;}
.control-label{font-weight:500;}
}
/*! CSS Used from: https://stories.botble.com/vendor/core/core/media/css/media.css?v=1619956554 */
.hidden{display:none!important;}
        </style>
@endsection
<div class="col-xs-12 col-sm-12 col-md-12">
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Title*</label>
        {!! Form::text('title', null, array('placeholder' => 'Title','id'=>'title','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @if(isset($post))
    @can('posts-slug-editing')
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'key','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]",'disabled','hidden','value' => $post->slug)) !!}
        <div class="checkbox-bird enable-editing-div">
            <input type="checkbox" class="enable-editing" value="1" id="enable-editing">
            <label for="enable-editing">Edit Slug</label>
        </div>
    </fieldset>
    @endcan
	<fieldset class="form-group">
        <label class="form-label semibold" for="category">Category*</label>
        {!! Form::select('category_id', $categories,$post->category_id, array('id' => 'category','class' => 'form-control select2','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="slug">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'slug','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
	<fieldset class="form-group">
        <label class="form-label semibold" for="category">Category*</label>
        {!! Form::select('category_id', $categories,[], array('id' => 'category','class' => 'form-control select2')) !!}
    </fieldset>
    @endif
    <fieldset class="form-group">
        <label class="form-label semibold" for="sub_title">Sub Title</label>
        {!! Form::text('sub_title', null, array('placeholder' => 'Sub Title','id'=>'sub_title','class' => 'form-control')) !!}
    </fieldset>
	<fieldset class="form-group">
        <label class="form-label semibold" for="meta_title">Meta Title*</label>
        {!! Form::text('meta_title', null, array('placeholder' => 'Meta Title','id'=>'meta_title','class' => 'form-control','data-validation'=>"[NOTEMPTY]",'data-validation-message' => 'Meta title is required')) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="meta_desc">Meta Description*</label>
        {!! Form::textarea('meta_desc', null, array('placeholder' => 'Meta Description','id'=>'meta_desc','class' => 'form-control','rows' => 3,'data-validation'=>"[NOTEMPTY]",'data-validation-message' => 'Meta Description is required')) !!}
    </fieldset>
	<fieldset class="form-group">
        <label class="form-label semibold" for="summary">Summary*</label>
        {!! Form::textarea('summary', null, array('placeholder' => 'Summary','id'=>'summary','class' => 'form-control','rows' => 3,'data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="description">Description*</label>
        {!! Form::textarea('description', null, array('placeholder' => 'Details','id'=>'description','class' => 'form-control','rows' => 3,'data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <div class="widget-body">
        <a href="#" class="btn-trigger-show-seo-detail">Edit SEO meta</a>
        <div class="seo-preview">
        <p class="default-seo-description hidden">Setup meta title &amp; description to make your site easy to discovered on search engines such as Google</p>
        <div class="existed-seo-meta">
        <span class="page-title-seo">Kiran KC Is a good Boy</span>
        <div class="page-url-seo ws-nm">
        <p>https://stories.botble.com/</p>
        </div>
        <div class="ws-nm">
        <span style="color: #70757a;">May 02, 2021 - </span>
        <span class="page-description-seo">ahskjda skljdhasjdhakjdhajksldhkas dhlajksd kjlahsd ljalsjdhkasdasasdas</span>
        </div>
        </div>
        </div>
        <div class="seo-edit-section">
        <hr>
        <div class="form-group">
        <label for="seo_title" class="control-label">SEO Title</label>
        <input class="form-control is-valid" id="seo_title" placeholder="SEO Title" data-counter="120" name="seo_meta[seo_title]" type="text" aria-invalid="false"><small class="charcounter">(98 character(s) remain)</small>
        </div>
        <div class="form-group">
        <label for="seo_description" class="control-label">SEO description</label>
        <textarea class="form-control is-valid" rows="3" id="seo_description" placeholder="SEO description" data-counter="155" name="seo_meta[seo_description]" cols="50" aria-invalid="false"></textarea><small class="charcounter">(84 character(s) remain)</small>
        </div>
        </div>
        </div>
	<fieldset class="form-group">
		<label class="form-label semibold" for="image">Image*</label>
		 <div class="uploading-container-left" style="position:relative;">
			<div class="drop-zone" id="drop-zone-image">
				<i class="font-icon font-icon-cloud-upload-2"></i>
				<div class="drop-zone-caption">Upload Image</div>
				<span style="padding: 3px 11px;border-top-width: 0px;" class="btn btn-rounded btn-file">
					<span style="font-size:11px;">Choose file</span>
                     @if(isset($post))
					<input type="file" class="image_input" id="image" data-id="image" name="featured_image">
                    @else
                    <input type="file" class="image_input" id="image" data-id="image" name="featured_image" data-validation="[NOTEMPTY]" data-validation-message='Image required'>
                    @endif
				</span>
			</div>
            @if(isset($post))
			<div class="upload-item responsive" {{$post->featured_image == null ? 'hidden' : ''}} id="image-input-container">
				<img class="image-preview img-responsive" id="image-input" src="{{$post->featured_image != null ? asset($post->featured_image) : ''}}"/>
			</div>
            @else
            <div class="upload-item responsive" hidden id="image-input-container">
				<span class="close remove-image"  id="close-image-preview">x</span>
				<img class="image-preview img-responsive" id="image-input" src=""/>
			</div>
            @endif
		</div>
	</fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="tags">Tags</label>
        @if(isset($post))
            @php
                if($post->tags){
                    $tags = $post->tags;
                }else{
                    $tags = null;
                }
            @endphp
            {!! Form::text('tags', $tags, array('placeholder' => 'Tags','id'=>'tags','class' => 'form-control','data-validation'=>"[NOTEMPTY]",'data-validation-message' => 'Tags are required')) !!}
        @else
            {!! Form::text('tags', null, array('placeholder' => 'Tags','id'=>'tags','class' => 'form-control','data-validation'=>"[NOTEMPTY]",'data-validation-message' => 'Tags are required')) !!}
        @endif
    </fieldset>
	<fieldset class="form-group">
    <label class="form-label semibold" for="status">Featured*</label>
        <div class="checkbox-slide">
        @if(isset($post))
            {!! Form::checkbox('featured', true, $post->featured,array('id'=>'featured')); !!}
        @else
            {!! Form::checkbox('featured', true, true,array('id'=>'featured')); !!}
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
            {!! Form::checkbox('status', true, true,array('id'=>'status')); !!}
        @endif
            <label for="status"></label>
        </div>
    </fieldset>
    @can('posts-publish')
    <fieldset class="form-group">
    <label class="form-label semibold" for="status">Published*</label>
        <div class="checkbox-slide">
        @if(isset($post))
            {!! Form::checkbox('published', true, $post->published,array('id'=>'published')); !!}
        @else
            {!! Form::checkbox('published', true, false,array('id'=>'published')); !!}
        @endif
            <label for="published"></label>
        </div>
    </fieldset>
    @endcan
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
@section('js')
<script src="{{asset('admin/ckeditor-3/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
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
                $('.unique-editing').fadeIn(600);
                $('.unique-editing').removeAttr("hidden");
				$('.unique-editing').removeAttr("disabled");
			}else{
                $('.unique-editing').fadeOut();
                $('.unique-editing').attr("hidden",true);
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
    @if(!isset($post))
    $('.remove-image').click(function(){
        var key = $(this).attr("cid");
        $('#image').val('');
        $('#image-input-container').attr("hidden","true");
    });
    @endif
    $(function(event) {
        $('#tags-editor-textarea').tagEditor();
    });
    $(document).on("keydown", ":input:not(textarea)", function(event) {
        return event.key != "Enter";
    });
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('posts.upload_image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].on('change', function ()
        {
            var editorName = $(this)[0].name;
            CKEDITOR.instances[editorName].updateElement();
        });
    }
    $('input[name=tags]').tokenfield();
</script>
@endsection


