@if(session()->has('created'))
    <div class="alert alert-success">
        {{ session('created') }}
    </div>
@endif

@if(session()->has('update'))
    <div class="alert alert-success">
        {{ session('update') }}
    </div>
@endif

@if(session()->has('deleted'))
    <div class="alert alert-success">
        {{ session('deleted') }}
    </div>
@endif
