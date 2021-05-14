@section('css')
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
<section class="box-typical">
    <div class="box-typical-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Configuration</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_settings as $setting)
                    <tr>
                        <td>
                            {{$setting->title}}
                            <span style="cursor:pointer; opacity:0.6;"  data-toggle="tooltip" data-placement="top" title="{{$setting->detail}}" data-original-title="No description Set"><i class="fa fa-info-circle"></i></span>
                            @if(isSuperAdmin(auth()->user()->id))
                            <span class="copy-key" style="cursor:pointer; opacity:0.6;" data-toggle="tooltip" data-key="{{$setting->key}}" data-placement="top" title="Copy Key" data-original-title="Copy Key"><i class="font-icon font-icon-doc"></i></span>
                            @endif
                            @php
                                $last_updated = \Carbon\Carbon::parse($setting->updated_at);
                            @endphp
                            <span style="cursor:pointer; opacity:0.6;" data-toggle="tooltip" data-key="{{$setting->key}}" data-placement="top" title="{{date_format($last_updated,'F d, Y')}}" data-original-title="Last Updated at {{$setting->updated_at}}"><i class="fa fa-clock-o"></i></span>
                        </td>
                        <td>
                            @if ($setting->field_type == "text_box")
                                <input type="text" class="form-control" placeholder="{{$setting->title}}" name="{{ $setting->key }}" value="{{$setting->config_value}}">
                            @elseif($setting->field_type == "number")
                                <input type="number" class="form-control" placeholder="{{$setting->title}}" name="{{ $setting->key }}" value="{{$setting->config_value}}">
                            @elseif($setting->field_type == "text_area")
                                <textarea placeholder="{{$setting->title}}" class="form-control" name="{{ $setting->key  }}">{{$setting->config_value}}</textarea>
                                @elseif($setting->field_type == "select_dropdown")
                            <?php $options = json_decode($setting->options); ?>
                            <?php $selected_value = (isset($setting->config_value) && !empty($setting->config_value)) ? $setting->config_value : NULL; ?>
                            <select class="form-control select2" name="{{ $setting->key }}">
                                <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                @if(isset($options->options))
                                    @foreach($options->options as $index => $option)
                                        <option value="{{ $index }}" @if($default == $index && $selected_value === NULL) selected="selected" @endif @if($selected_value == $index) selected="selected" @endif>{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                        @elseif($setting->field_type == "radio_button")
                            <?php $options = json_decode($setting->options); ?>
                            <?php $selected_value = (isset($setting->config_value) && !empty($setting->config_value)) ? $setting->config_value : NULL; ?>
                            <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                            <ul class="radio">
                                @if(isset($options->options))
                                    @foreach($options->options as $index => $option)
                                        <li>
                                            <input type="radio" id="radio-option-{{ $index }}-{{$setting->key}}" name="{{ $setting->key }}"
                                                    value="{{ $index }}" @if($default == $index && $selected_value === NULL) checked @endif @if($selected_value == $index) checked @endif>
                                            <label for="radio-option-{{ $index }}-{{$setting->key}}">{{ $option }}</label>
                                            <div class="check"></div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        @elseif($setting->field_type == "checkbox")
                            <?php $options = json_decode($setting->options); ?>
                            <?php $checked = (isset($setting->config_value) && $setting->config_value == 1) ? true : false; ?>
                            @if (isset($options->on) && isset($options->off))
                                <div class="checkbox-slide">
                                    <span class="radio-settings-label label label-pill label-default">{{$options->off}}</span>
                                    <input type="checkbox" id="check-slide-{{$setting->key}}" name="{{ $setting->key }}" class="toggleswitch" @if($checked) checked @endif">
                                    <label style="top:5px;" for="check-slide-{{$setting->key}}"></label>
                                    <span class="radio-settings-label label label-pill label-primary">{{$options->on}}</span>
                                </div>
                                @else
                                    <input type="checkbox" name="{{ $setting->key }}" @if($checked) checked @endif class="toggleswitch">
                                @endif
                            </td>
                        @elseif($setting->field_type == "image")
                            <div class="uploading-container-left" style="position:relative;">
                                <div class="drop-zone" id="drop-zone-{{$setting->key}}">
                                    <i class="font-icon font-icon-cloud-upload-2"></i>
                                    <div class="drop-zone-caption">Upload Image</div>
                                    <span style="padding: 3px 11px;border-top-width: 0px;" class="btn btn-rounded btn-file">
                                        <span style="font-size:11px;">Choose file</span>
                                        <input type="file" class="image_input" id="setting-image-{{$setting->key}}" data-id="{{$setting->key}}" name="{{$setting->key}}">
                                    </span>
                                </div>
                                <div class="upload-item responsive" {{$setting->config_value == null ? 'hidden' : '' }} id="image-input-container-{{$setting->key}}">
                                    <span class="close remove-settings-image" cid="{{$setting->key}}" cname="{{$setting->title}}" id="close-image-preview-{{$setting->key}}">x</span>
                                    <img class="settings-image-preview img-responsive" id="image-input-{{$setting->key}}" src="{{$setting->config_value ? render($setting->config_value) : ''}}"/>
                                </div>
                            </div>
                        @elseif($setting->field_type == 'file')
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" id="setting-file-{{$setting->key}}" data-id="{{$setting->key}}" name="{{$setting->key}}">
                            </div>
                            @if(!empty($setting->config_value))
                            <div style="margin-left:0px;" class="col-md-6 upload-item responsive" {{$setting->config_value == null ? 'hidden' : '' }} id="image-input-container-{{$setting->key}}">
                                <span class="close remove-settings-image" cid="{{$setting->key}}" cname="{{$setting->title}}" id="close-image-preview-{{$setting->key}}">x</span>
                                <a target="_blank" href="{{render($setting->config_value)}}">
                                    @php
                                        $url = $setting->config_value;
                                        $content = explode('/',$url);
                                    @endphp
                                    {{end($content)}}
                                </a>
                            </div>
                            @endif

                        @elseif($setting->field_type == 'multiple_checkbox')
                                <?php $options = json_decode($setting->options); ?>
                                <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                <?php $selected_value = (isset($setting->config_value) && !empty($setting->config_value)) ? json_decode($setting->config_value) : NULL; ?>
                                @if(isset($options->options))
                                    @foreach($options->options as $index => $option)
                                        <div class="checkbox-bird">
                                            <input type="checkbox" id="multi-check-{{$index}}-{{$setting->key}}" name="{{ $setting->key }}[]" value="{{ $index }}" @if($selected_value != null) @if(in_array($index,$selected_value)) checked @endif @endif>
                                            <label for="multi-check-{{$index}}-{{$setting->key}}">{{$option}}</label>
                                        </div>
                                    @endforeach
                                @endif
                        @elseif($setting->field_type == 'rich_text_box')
                            <div class="summernote-theme-3">
                                <textarea class="summernote" name="{{$setting->key}}">{{$setting->config_value}}</textarea>
                            </div>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" integrity="sha512-GZ1RIgZaSc8rnco/8CXfRdCpDxRCphenIiZ2ztLy3XQfCbQUSCuk8IudvNHxkRA3oUg6q0qejgN/qqyG1duv5Q==" crossorigin="anonymous"></script>
<script src="{{asset('admin/js/summernote-lite.min.js')}}"></script>
<script src="{{asset('admin/js/JQlipboard.min.js')}}"></script>
<script>
    function readURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-input-container-'+id).removeAttr("hidden");
                $('#image-input-'+id).attr('src', e.target.result);
                $('#close-image-preview-'+id).removeAttr("hidden");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image_input").change(function() {
        var id = $(this).attr("data-id");
        readURL(this,id);
    });

    $('.remove-settings-image').click(function(){
        var key = $(this).attr("cid");
        var name = $(this).attr("cname");
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this value!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
            $.post("{{route('configuration-update.destroy_file')}}",{key:key,_token:"{{csrf_token()}}"},function(data){
                swal(name+" value has been cleared!", {
                icon: "success",
                }).then(function(){
                    $('#setting-image-'+key).val('');
                    $('#image-input-container-'+key).attr("hidden","true");
                });
            });
            }
        });

    });

    $('.summernote').summernote({
             width:600,
    });

    $('.copy-key').click(function(){
        var key = $(this).attr("data-key");
        $.copy(key);
        $(this).attr("data-original-title","Copied").tooltip('show');
        $(this).attr("data-original-title","Copy Key");
    })
</script>
@endsection