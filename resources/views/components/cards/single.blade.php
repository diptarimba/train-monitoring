<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow">
            <div class="card-header border-gray-100 d-flex justify-content-between align-items-center">
                <a href="{{ $back }}" class="btn btn-outline-primary mx-1 my-1">{{Route::is('me.index') ? 'Home' : 'Back'}}</a>
                {{$header}}
            </div>
            <div class="card-body">
                {{$body}}
            </div>
        </div>
    </div>
</div>
