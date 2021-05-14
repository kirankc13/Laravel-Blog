 @if ($errors->any())
    <div class="alert alert-danger alert-fill alert-close alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="font-icon font-icon-inline font-icon-warning"></i>
        <strong>Errors</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle" aria-hidden="true"></i> {!!Session::get('success')!!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <i class="fa fa-minus-circle" aria-hidden="true"></i> {!!Session::get('error')!!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(setting('admin-maintenance-mode'))
    <div class="alert alert-info" role="alert">
        <i class="fa fa-info-circle" aria-hidden="true"></i> System is currently down for maintenance
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<div id="ajax-messages" hidden>
</div>