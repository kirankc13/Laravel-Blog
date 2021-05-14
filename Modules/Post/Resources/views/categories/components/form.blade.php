<div class="col-xs-12 col-sm-12 col-md-12">
    <fieldset class="form-group">        
        <label class="form-label semibold" for="title">Title*</label>
        {!! Form::text('title', null, array('placeholder' => 'Title','id'=>'title','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @if(isset($category))
    @can('categories-slug-editing')
    <fieldset class="form-group">        
        <label class="form-label semibold" for="title">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'key','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]",'disabled','hidden','value' => $category->slug)) !!}
        <div class="checkbox-bird enable-editing-div">
            <input type="checkbox" class="enable-editing" value="1" id="enable-editing">
            <label for="enable-editing">Edit Slug</label>
        </div>          
    </fieldset>
    @endcan
	<fieldset class="form-group">        
        <label class="form-label semibold" for="parent_id">Parent</label>        
        {!! Form::select('parent_id', $parent_categories,$category->parent_id, array('id' => 'parent_id','class' => 'form-control select2')) !!}        
    </fieldset>
    @else
    <fieldset class="form-group">        
        <label class="form-label semibold" for="slug">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'slug','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}       
    </fieldset>
	<fieldset class="form-group">        
        <label class="form-label semibold" for="parent_id">Parent</label>        
        {!! Form::select('parent_id', $parent_categories,[], array('id' => 'parent_id','class' => 'form-control select2')) !!}        
    </fieldset>
    @endif 
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
		<label class="form-label semibold" for="image">Image*</label>
		 <div class="uploading-container-left" style="position:relative;">                            
			<div class="drop-zone" id="drop-zone-image">                                              
				<i class="font-icon font-icon-cloud-upload-2"></i>
				<div class="drop-zone-caption">Upload Image</div>
				<span style="padding: 3px 11px;border-top-width: 0px;" class="btn btn-rounded btn-file">
					<span style="font-size:11px;">Choose file</span>
					<input type="file" class="image_input" id="image" data-id="image" name="image">
				</span>
			</div>  
            @if(isset($category))                
			<div class="upload-item responsive" {{$category->image == null ? 'hidden' : ''}} id="image-input-container">            				
				<img class="image-preview img-responsive" id="image-input" src="{{$category->image != null ? render($category->image) : ''}}"/>    
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
    <label class="form-label semibold" for="status">Featured*</label>
        <div class="checkbox-slide">
        @if(isset($category))
            {!! Form::checkbox('featured', true, $category->featured,array('id'=>'featured')); !!}
        @else
            {!! Form::checkbox('featured', true, true,array('id'=>'featured')); !!}
        @endif
            <label for="featured"></label>
        </div>
    </fieldset>      
    <fieldset class="form-group">
    <label class="form-label semibold" for="status">Status*</label>
        <div class="checkbox-slide">
        @if(isset($category))
            {!! Form::checkbox('status', true, $category->status,array('id'=>'status')); !!}
        @else
            {!! Form::checkbox('status', true, true,array('id'=>'status')); !!}
        @endif
            <label for="status"></label>
        </div>
    </fieldset>   	      
</div> 
<div class="col-xs-12 col-sm-12 col-md-12">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

@section('js')
<script>      
	@if(isset($category))
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
    @if(!isset($category))    
    $('.remove-image').click(function(){
        var key = $(this).attr("cid");        
        $('#image').val('');
        $('#image-input-container').attr("hidden","true");               
    });
    @endif

</script>

@endsection


