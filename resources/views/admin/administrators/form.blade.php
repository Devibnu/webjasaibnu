<div class="card">
    <div class="card-header pb-0">
        <h6>{{ $button }}</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger text-white">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($method !== 'POST')
                @method($method)
            @endif

            <div class="row">
                <div class="col-md-8">
                    <label>Full Name</label>
                    <input name="name" class="form-control mb-3" value="{{ old('name', $user->name) }}" required>

                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control mb-3" value="{{ old('email', $user->email) }}" required>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Password @if(!$isCreate) (Leave blank to keep current) @endif</label>
                            <input type="password" name="password" class="form-control mb-3" @if($isCreate) required @endif>
                        </div>
                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control mb-3" @if($isCreate) required @endif>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check form-switch mb-4 mt-4">
                        <input type="hidden" name="is_admin" value="0">
                        <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" value="1" @checked(old('is_admin', $user->exists ? $user->is_admin : true))>
                        <label class="form-check-label font-weight-bold" for="is_admin">Admin Access</label>
                    </div>
                    <small class="text-secondary d-block mb-4">Grants full management rights across the Soft UI admin panel.</small>

                    <button class="btn bg-gradient-info w-100" type="submit">{{ $button }}</button>
                    <a href="{{ route('admin.administrators.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
