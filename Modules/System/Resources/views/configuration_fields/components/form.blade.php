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
    @if(isset($config_field_type))
    <fieldset class="form-group">
        <label class="form-label semibold" for="title">Configuration Key*</label>
        {!! Form::text('key', null, array('placeholder' => 'Configuration Key','id'=>'key','hidden','class' => 'form-control unique-editing','data-validation'=>"[NOTEMPTY]",'disabled')) !!}
        <div class="checkbox-bird enable-editing-div">
            <input type="checkbox" class="enable-editing" value="1" id="enable-editing">
            <label for="enable-editing">Enable Editing</label>
        </div>
    </fieldset>
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="key">Configuration Key*</label>
        {!! Form::text('key', null, array('placeholder' => 'Configuration Key','id'=>'key','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @endif
    @if(isset($config_field_type))
    <fieldset class="form-group">
        <label class="form-label semibold" for="configuration_type">Configuration Type*</label>
        {!! Form::select('configuration_type', array('system_config' => 'System Configuration', 'user_config' => 'User Configuration'),$config_field_type->configuration_type, array('id' => 'configuration_type','class' => 'form-control select2','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="group">Group*</label>
        {!! Form::select('group', $group_array,$config_field_type->group, array('id' => 'group','class' => 'form-control select2-tags','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="configuration_type">Field Type*</label>
        {!! Form::select('field_type', ['text_box'=>'Text Box','text_area' => 'Text Area','number'=>'Number','rich_text_box' => 'Rich Text Box','checkbox' => 'Checkbox','multiple_checkbox' => 'Multiple Checkbox','radio_button' => 'Radio button','select_dropdown'=>'Select Dropdown','image'=>'Image','file'=>'File','number'=>'Number'],$config_field_type->field_type, array('id' => 'field_type','class' => 'form-control select2 field_type','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @else
    <fieldset class="form-group">
        <label class="form-label semibold" for="configuration_type">Configuration Type*</label>
        {!! Form::select('configuration_type', array('system_config' => 'System Configuration', 'user_config' => 'User Configuration'),[], array('id' => 'configuration_type','class' => 'form-control select2','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="group">Group*</label>
        {!! Form::select('group', $group_array,[], array('id' => 'group','class' => 'form-control select2-tags','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="configuration_type">Field Type*</label>
        {!! Form::select('field_type', ['text_box'=>'Text Box','text_area' => 'Text Area','rich_text_box' => 'Rich Text Box','checkbox' => 'Checkbox','multiple_checkbox' => 'Multiple Checkbox','radio_button' => 'Radio button','select_dropdown'=>'Select Dropdown','image'=>'Image','file'=>'File'],[], array('id' => 'field_type','class' => 'form-control select2 field_type','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    @endif
    <fieldset class="form-group" id="options_field">
        <label class="form-label semibold" for="options">Options (JSON Format only allowed) <i style="cursor:pointer;" class="font-icon font-icon-question" data-toggle="modal" data-target=".bd-example-modal-lg"></i></label>
        {!! Form::textarea('options', null, array('rows'=>'6','data-editor'=>"markdown")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="name">Detail</label>
        {!! Form::textarea('detail', null, array('placeholder' => 'Detail','id'=>'detail','class' => 'form-control','rows'=>'3')) !!}
    </fieldset>
    <fieldset class="form-group">
    <label class="form-label semibold" for="user_configurable">User Configurable?*</label>
        <div class="checkbox-slide">
        @if(isset($config_field_type))
            {!! Form::checkbox('user_configurable', true, $config_field_type->user_configurable,array('id'=>'user_configurable')); !!}
        @else
            {!! Form::checkbox('user_configurable', true, false,array('id'=>'user_configurable')); !!}
        @endif
            <label for="user_configurable"></label>
        </div>
    </fieldset>
    @if(isSuperAdmin(auth()->user()->id))
    <fieldset class="form-group">
    <label class="form-label semibold" for="status">For developer*</label>
        <div class="checkbox-slide">
        @if(isset($config_field_type))
            {!! Form::checkbox('for_developer', true, $config_field_type->for_developer,array('id'=>'for_developer')); !!}
        @else
            {!! Form::checkbox('for_developer', true, false,array('id'=>'for_developer')); !!}
        @endif
            <label for="for_developer"></label>
        </div>
    </fieldset>
    @endif
    <fieldset class="form-group">
    <label class="form-label semibold" for="enable_view_for_user">Enable View for User*</label>
        <div class="checkbox-slide">
        @if(isset($config_field_type))
            {!! Form::checkbox('enable_view_for_user', true, $config_field_type->enable_view_for_user,array('id'=>'enable_view_for_user')); !!}
        @else
            {!! Form::checkbox('enable_view_for_user', true, false,array('id'=>'enable_view_for_user')); !!}
        @endif
            <label for="enable_view_for_user"></label>
        </div>
    </fieldset>
    <fieldset class="form-group">
    <label class="form-label semibold" for="status">Status*</label>
        <div class="checkbox-slide">
        @if(isset($config_field_type))
            {!! Form::checkbox('status', true, $config_field_type->status,array('id'=>'status')); !!}
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
@include($base_view.'.components.json_format_helper')
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" integrity="sha512-GZ1RIgZaSc8rnco/8CXfRdCpDxRCphenIiZ2ztLy3XQfCbQUSCuk8IudvNHxkRA3oUg6q0qejgN/qqyG1duv5Q==" crossorigin="anonymous"></script>
<script>
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
                $("#key").val(title);
            });
            @endif

</script>

@endsection