@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade py-1">
        <div class="alert-body">
            <button class="close py-1 ml-5" data-dismiss="alert">
                <span>x</span>
            </button>
            <p class="mr-3">{{ $message }}</p>
        </div>
    </div>
@endif
