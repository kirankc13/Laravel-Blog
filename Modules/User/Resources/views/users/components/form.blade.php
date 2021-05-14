<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <fieldset class="form-group">
            <label class="form-label semibold" for="name">Full Name*</label>
            {!! Form::text('name', null, array('placeholder' => 'Full Name','id'=>'name','class' => 'form-control',"data-validation"=>"[L>=4, L<=18, MIXED]","data-validation-message"=>"$ must be between 4 and 18 characters. No special characters allowed.","data-validation-regex"=>"/^((?!superadmin).)*$/i","data-validation-regex-message"=>"The word &quot;Superadmin&quot; is not allowed in the $")) !!}
        </fieldset>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <fieldset class="form-group">
            <label class="form-label semibold" for="name">Display Name</label>
            {!! Form::text('display_name', null, array('placeholder' => 'Display Name','id'=>'display_name','class' => 'form-control',"data-validation"=>"[L>=4, L<=18, MIXED]","data-validation-message"=>"$ must be between 4 and 18 characters. No special characters allowed.","data-validation-regex"=>"/^((?!superadmin).)*$/i","data-validation-regex-message"=>"The word &quot;Superadmin&quot; is not allowed in the $")) !!}
        </fieldset>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <fieldset class="form-group">
            <label class="form-label semibold" for="name">User Name</label>
            {!! Form::text('username', null, array('placeholder' => 'User Name','id'=>'username','class' => 'form-control',"data-validation"=>"[L>=4, L<=18, MIXED]","data-validation-message"=>"$ must be between 4 and 18 characters. No special characters allowed.","data-validation-regex"=>"/^((?!superadmin).)*$/i","data-validation-regex-message"=>"The word &quot;Superadmin&quot; is not allowed in the $")) !!}
        </fieldset>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="email">Email*</label>
            {!! Form::text('email', null, array('placeholder' => 'Email','id'=>'email','class' => 'form-control','data-validation'=>"[EMAIL]")) !!}
        </div>
    </div>
    @if(isset($user))
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="password">Password*</label>
            {!! Form::password('password', array('placeholder' => 'Password','id' => 'password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="confirm_password">Confirm Password*</label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','id' => 'confirm_password','class' => 'form-control')) !!}
        </div>
    </div>
    @else
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="password">Password*</label>
            {!! Form::password('password', array('placeholder' => 'Password','id' => 'password','class' => 'form-control','data-validation-message'=>"$ must be at least 6 characters",'data-validation'=>"[L>=6]")) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="confirm_password">Confirm Password*</label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','id' => 'confirm_password','class' => 'form-control',"data-validation"=>"[V==password]","data-validation-message"=>"$ does not match the password")) !!}
        </div>
    </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="password">About</label>
            {!! Form::textarea('about', null,array('placeholder' => 'About','id' => 'about','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <label class="form-label semibold" for="status">Status*</label>
        <div class="checkbox-slide">
        @if(isset($user))
            {!! Form::checkbox('status', true, $user->status,array('id'=>'status')); !!}
        @else
            {!! Form::checkbox('status', true, true,array('id'=>'status')); !!}
        @endif
            <label for="status"></label>
        </div>
    </div>
    @if(isset($user))
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="roles">Roles*</label>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2','multiple','id'=>'roles')) !!}
        </div>
    </div>
    @else
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="roles">Roles*</label>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control select2','multiple','id'=>'roles')) !!}
        </div>
    </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="Website">Website</label>
            {!! Form::url('website', null, array('placeholder' => 'Website Link','id'=>'Website','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="facebook">Facebook</label>
            {!! Form::url('facebook', null, array('placeholder' => 'Facebook Link','id'=>'facebook','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="twitter">Twitter</label>
            {!! Form::url('twitter', null, array('placeholder' => 'Twitter Link','id'=>'twitter','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="Instagram">Instagram</label>
            {!! Form::url('instagram', null, array('placeholder' => 'Instagram Link','id'=>'Instagram','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label class="form-label semibold" for="LinkedIn">LinkedIn</label>
            {!! Form::url('linkedin', null, array('placeholder' => 'LinkedIn Link','id'=>'LinkedIn','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>