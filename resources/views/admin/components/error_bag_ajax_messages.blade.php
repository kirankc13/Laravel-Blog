@if ($errors->any())
<div class="alert alert-danger" role="alert">
        <i class="fa fa-minus-circle" aria-hidden="true"></i> Errors
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>  
    </div>
@endif