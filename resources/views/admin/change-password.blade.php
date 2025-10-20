@extends("layouts.admin.app")

@section("title", "Change Password")

@section("content")
    {{-- Flash Message --}}
    <div>
        @if (session("success"))
            <x-flash :msg="session('success')" />
        @elseif (session("failed"))
            <x-flash :msg="session('failed')" bg="alert-danger" />
        @endif
    </div>
    
    {{-- Breadcrumb --}}
    <h4 class="py-3 mb-4">
        <a href="{{ route("admin.dashboard") }}" class="text-muted fw-light">Dashboard /</a> 
        Change Password
    </h4>

    {{-- Content --}}
    <div class="row">
        {{-- Form --}}
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <p>
                        Change your password.
                    </p>

                    {{-- Form --}}
                    <form id="formAuthentication" class="mb-3" action="{{ route("admin.change-password.post") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                placeholder="Enter your current password" autocomplete="off" autofocus />
                            @error("current_password")
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                placeholder="Enter new password" autocomplete="off" autofocus />
                            @error("new_password")
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                                placeholder="Enter confirm new password" autocomplete="off" autofocus />
                            @error("new_password_confirmation")
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary d-grid w-100">Change Password</button>
                    </form>

                </div>
            </div>
        </div>

        {{-- Profile Card --}}
        <div class="col-md-4">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                                height="100" width="100" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ Auth::user()->name }}</h4>
                                <span class="badge bg-label-secondary mt-1">Admin</span>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-medium me-1">Name:</span>
                                <span>{{ Auth::user()->name }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="fw-medium me-1">Username:</span>
                                <span>{{ Auth::user()->username }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-medium me-1">Email:</span>
                                <span>{{ Auth::user()->email }}</span>
                            </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
