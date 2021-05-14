@section('css')
<style>
select.select2 {
  display: block;
  visibility: visible;
  position: absolute;
  margin-top: 4px;
  margin-left: 4px;
  width: 190px;
  height: 20px;
 }
</style>
@endsection

<div class="col-xs-12 col-sm-12 col-md-12">
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Title*</label>
        {!! Form::text('title', null, array('placeholder' => 'Title','id'=>'title','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @if(isset($pages))
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'slug','hidden','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]",'disabled')) !!}
        <div class="checkbox-bird enable-editing-div">
            <input type="checkbox" class="enable-editing" value="1" id="enable-editing">
            <label for="enable-editing">Enable Editing</label>
        </div>
    </fieldset>
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="key">Slug*</label>
        {!! Form::text('slug', null, array('placeholder' => 'Slug','id'=>'slug','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]")) !!}
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
        <label class="form-label semibold" for="description">Description*</label>
        {!! Form::textarea('description', null, array('placeholder' => 'Description','rows'=>'4','id'=>'description','class' => 'form-control','rows' => 3)) !!}
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
            @if(isset($page))
			<div class="upload-item responsive" {{$page->image == null ? 'hidden' : ''}} id="image-input-container">
				<img class="image-preview img-responsive" id="image-input" src="{{$page->image != null ? render($page->image) : ''}}"/>
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
    <label class="form-label semibold" for="status">Status*</label>
        <div class="checkbox-slide">
        @if(isset($page))
            {!! Form::checkbox('status', true, $page->status,array('id'=>'status')); !!}
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
<script src="{{asset('admin/ckeditor-3/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" integrity="sha512-GZ1RIgZaSc8rnco/8CXfRdCpDxRCphenIiZ2ztLy3XQfCbQUSCuk8IudvNHxkRA3oUg6q0qejgN/qqyG1duv5Q==" crossorigin="anonymous"></script>
<script>
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
        @if(isset($_COOKIE['dark_mode']))
        CKEDITOR.addCss('.cke_editable { background-color: black; color: white }');
    @else
        CKEDITOR.addCss('.cke_editable { background-color: white; color: black }');
    @endif
    $(function () {
        $('textarea[data-editor]').each(function () {
            var textarea = $(this);
            var mode = textarea.data('editor');
            var editDiv = $('<div>', {
                position: 'absolute',
                height: textarea.height(),
                'class': textarea.attr('class')
            }).insertBefore(textarea);
            textarea.css('display', 'none');
            var editor = ace.edit(editDiv[0]);
            editor.renderer.setShowGutter(true);
            editor.getSession().setValue(textarea.val());
            editor.session.setMode("ace/mode/json");
            editor.getSession().on("change", function () {
                textarea.val(editor.getSession().getValue());
            });
        });
        $('#options_field').hide();
    });

       $('.field_type').on('change',function(){
           if($(this).val() == 'checkbox' || $(this).val() == 'radio_button' || $(this).val() == 'select_dropdown' || $(this).val() == 'multiple_checkbox'){
               $('#options_field').show();
           }else{
               $('#options_field').hide();
           }
        });
        $(document).ready(function(){
            var field_type = $('#field_type').val();
           if(field_type == 'checkbox' || field_type== 'radio_button' || field_type == 'select_dropdown' || field_type == 'multiple_checkbox'){
               $('#options_field').show();
           }else{
               $('#options_field').hide();
           }
        });


        @if(isset($config_field_type))
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
                    $('.unique-editing').fadeIn(500);
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

    $('.remove-image').click(function(){
        var key = $(this).attr("cid");
        $('#image').val('');
        $('#image-input-container').attr("hidden","true");
    });

    $(".image_input").change(function() {
        var id = $(this).attr("data-id");
        readURL(this,id);
    });

    $('#show-featured-image').click(function(){
        var src = $('#image-input').attr("src");
        $('#featured_image_modal').attr("src",src);
        $('#view-image').modal('show');
    });

</script>

@endsection