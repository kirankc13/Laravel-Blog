@if($message)
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle" aria-hidden="true"></i> {!! $message !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
@endif