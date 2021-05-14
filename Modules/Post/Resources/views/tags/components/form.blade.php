<div class="col-xs-12 col-sm-12 col-md-12">
    <fieldset class="form-group">
        <label class="form-label semibold" for="name">Name*</label>
        {!! Form::text('name', null, array('placeholder' => 'Name','id'=>'name','class' => 'form-control','data-validation'=>"[NOTEMPTY]")) !!}
    </fieldset>
    <fieldset class="form-group">
        <label class="form-label semibold" for="description">Description</label>
        {!! Form::textarea('description', null, array('placeholder' => 'Description','id'=>'description','class' => 'form-control description','rows' => 3)) !!}
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
<script src="{{asset('admin/ckeditor-3/ckeditor.js')}}"></script>
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
    </script>

@endsection


