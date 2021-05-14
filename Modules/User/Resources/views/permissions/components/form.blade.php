@include('admin.components.messages')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <fieldset class="form-group">        
            <label class="form-label semibold" for="name">Name*</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','id'=>'name','class' => 'form-control', 'data-validation'=>"[NOTEMPTY]")) !!}                    
        </fieldset>
        <fieldset class="form-group">    					
            <label class="form-label semibold" for="module">Module</label>
            {!! Form::select('module', $module_array,[], array('class' => 'form-control select2','id'=>'module','data-validation'=>"[NOTEMPTY]")) !!}
        </fieldset>
        <fieldset class="form-group">        
            <label class="form-label semibold" for="name">Group*</label>
            {!! Form::select('group', $group_array,[], array('id'=>'group','class' => 'form-control select2-tags','data-validation'=>"[NOTEMPTY]")) !!}                                                          
        </fieldset>
        <fieldset class="form-group">        
            <label class="form-label semibold" for="name">Description*</label>
            {!! Form::textarea('description', null, array('placeholder' => 'Description','id'=>'description','class' => 'form-control')) !!}                                                          
        </fieldset>
    </div>                                                            
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
