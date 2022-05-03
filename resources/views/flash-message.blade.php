
@if ($message = Session::get('success'))
<br>
<div class="container btn-info ">
<div class="alert alert-solid-success" role="alert">
        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
           <span aria-hidden="true">&times;</span>
      </button>
       <strong>Well done!</strong> {{ $message }}
</div>
</div>
@endif



@if ($message = Session::get('error'))
<br>
<div class="container btn-info">
<div class="alert alert-solid-danger mg-b-0" role="alert">
        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Oh snap!</strong> {{ $message }}
</div>
</div>

@endif



@if ($message = Session::get('warning'))
<br>
<div class="container btn-info">
<div class="alert alert-solid-warning" role="alert">
        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Warning!</strong> {{ $message }}
</div>
</div>


@endif



@if ($message = Session::get('info'))
<br>
<div class="container btn-info">
 <div class="alert alert-solid-info" role="alert">
        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Heads up!</strong> {{ $message }}
    </div>
    </div>
@endif



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
