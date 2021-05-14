@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; bottom: 20px; right: 10px; animation-iteration-count: 1;">
    <strong>Success!</strong> {{Session::get('success')}}
    <button type="button" id="dismiss-message" style="padding-bottom:0px; padding-top:0px; bottom:0px;" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; bottom: 20px; right: 10px; animation-iteration-count: 1;">
    <strong>Oh Snap!</strong> {{Session::get('error')}}
    <button type="button" id="dismiss-message" style="padding-bottom:0px; padding-top:0px; bottom:0px;" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out; z-index: 1031; bottom: 20px; right: 10px; animation-iteration-count: 1;">
    <strong>Oh Snap!</strong> {{Session::get('error')}}
    @foreach ($errors->all() as $error)
        <p style="margin-bottom:0px;">{!! $error !!}</p>
    @endforeach
    <button type="button" id="dismiss-message" style="padding-bottom:0px; padding-top:0px; bottom:0px;" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif