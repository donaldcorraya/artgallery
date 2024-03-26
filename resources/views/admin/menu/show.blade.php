<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Details </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <div class="modal-body">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name </label>
                    <div class="col-sm-12">
                        <input type="text" name="name"  class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Email </label>
                    <div class="col-sm-12">
                        <input type="text" name="email"  class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-12">
                        <input type="text" name="username"  class="form-control" value="{{ $user->username }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Role </label>
                    <div class="col-sm-12">
                        @foreach($roles as $key => $role)
                        <span class="badge rounded-pill bg-info text-dark">{{ $role }}</span>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
    </div>
</div>