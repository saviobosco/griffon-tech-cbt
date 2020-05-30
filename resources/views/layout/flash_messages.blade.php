@if ($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success mt-2" role="alert">
        <i class="fa fa-check-circle"></i>
        <strong>Success:</strong>
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-soft-warning d-flex  align-items-center m-0 mt-2" role="alert">
        <i class="material-icons mr-3">error_outline</i>
        <div class="text-body"><strong>warning</strong>
            {{ Session::get('warning') }}
        </div>
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info mt-2" role="alert">
        <div class="text-body"><strong>Info - </strong>
            {{ Session::get('info') }}
        </div>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger mt-2" role="alert">
        <i class="fa fa-warning"></i>
        <strong>Error - </strong>
        {{ Session::get('error') }}
    </div>
@endif
