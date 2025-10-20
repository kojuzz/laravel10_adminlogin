@extends("layouts.admin.app")

@section("title", "About")

@section("content")
    {{-- Breadcrumb --}}
    <h4 class="py-3 mb-4">
        <a href="{{ route("admin.dashboard") }}" class="text-muted fw-light">Dashboard /</a>
        About
    </h4>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">About This Project</h5>
            <p class="card-text">
                This project is an Admin Login System built with Laravel 10 and PHP 8.3, designed to provide secure and
                user-friendly authentication features for admin users.
            </p>
            <p class="card-text">
                It includes the following main functionalities:
            <ul>
                <li>Admin User Registration and Login</li>
                <li>Two-Step Verification (via Email) for enhanced account security</li>
                <li>Forgot Password and Reset Password functionality to easily recover access</li>
                <li>Admin Profile Management and Change Password features for user account maintenance</li>
            </ul>
            </p>
            <p class="card-text">
                The frontend styling uses the Vuexy Admin Template, customized with Bootstrap 5 for a clean, responsive,
                and
                modern interface.
            </p>
            <p class="card-text">
                This project demonstrates best practices for authentication and admin management using Laravel’s
                built-in
                security features combined with an elegant UI design.
            </p>
            <a href="{{ route("admin.dashboard") }}" class="btn btn-outline-primary">Go to Dashboard</a>
        </div>
    </div>

@endsection
