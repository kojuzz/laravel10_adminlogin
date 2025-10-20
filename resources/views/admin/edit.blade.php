@extends("layouts.admin.app")

@section("title", "Edit Profile")

@section("content")
    {{-- Breadcrumb --}}
    <h4 class="py-3 mb-4">
        <a href="{{ route("admin.dashboard") }}" class="text-muted fw-light">Dashboard /</a>
        Edit Profile
    </h4>

    {{-- Content --}}
    <div class="row">
        {{-- Form --}}
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Manage Profile</h5>
                <div class="card-body">
                    <p>
                        Update your profile information.
                    </p>

                    {{-- Form --}}
                    <form id="formAuthentication" class="mb-3" action="{{ route("admin.update") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name" autocomplete="off" autofocus
                                value="{{ old("name", $user->name) }}" />
                            @error("name")
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter username" autocomplete="off"
                                value="{{ old("username", $user->username) }}" autofocus />
                            @error("username")
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email" autocomplete="off"
                                value="{{ old("email", $user->email) }}" />
                            @error("email")
                                <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary d-grid w-100">Update Information</button>
                    </form>

                    {{-- Divider --}}
                    <hr class="my-4" />

                    {{-- Delete Account --}}
                    <form id="deleteAccountForm" action="{{ route("admin.delete") }}" method="POST"
                        onsubmit="return confirmDelete()">
                        @csrf
                        <button type="submit" class="btn btn-danger d-grid w-100">Delete Account</button>
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

@section("scripts")
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this account? This action cannot be undone.');
        }
    </script>
@endsection
