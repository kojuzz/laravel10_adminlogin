@extends("layouts.admin.app")

@section("title", "Dashboard")

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
        Dashboard
    </h4>

    {{-- Content --}}
    <div class="row">
        {{-- Links --}}
        <div class="col-md-8">
            <div class="row mb-4">
                {{-- <h3>Info</h3> --}}
                <div class="col-sm-6 mb-4">
                    <div class="card card-border-shadow-primary h-100">
                        <a href="{{ route("admin.admin-list") }}" class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <h4 class="ms-1 mb-0">View Admins</h4>
                            </div>
                            <p>
                                View All Registered Admins
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="card card-border-shadow-primary h-100">
                        <a href="{{ route("admin.about") }}" class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <h4 class="ms-1 mb-0">About</h4>
                            </div>
                            <p>
                                About Project Information
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="card card-border-shadow-primary h-100">
                        <a href="{{ route("welcome") }}" class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <h4 class="ms-1 mb-0">Welcome Page</h4>
                            </div>
                            <p>
                                For Laravel and PHP Version Info
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <h3>Manage Profile</h3> --}}
                <div class="col-sm-6 mb-4">
                    <div class="card card-border-shadow-warning h-100">
                        <a href="{{ route("admin.edit") }}" class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <h4 class="ms-1 mb-0">Edit Profile</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="card card-border-shadow-warning h-100">
                        <a href="{{ route("admin.change-password") }}" class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <h4 class="ms-1 mb-0">Change Password</h4>
                            </div>
                        </a>
                    </div>
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
