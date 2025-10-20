@extends("layouts.app")

@section("title", "Privacy Policy")

@section("content")
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                {{-- Login Card --}}
                <div class="card">
                    <div class="card-body">

                        {{-- Logo --}}
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route("login") }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <x-svg icon="vuexy" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bold ms-1">
                                    Admin Panel Test
                                </span>
                            </a>
                        </div>

                        {{-- Title --}}
                        <h4 class="mb-1 pt-2">Privacy Policy (for Testing Purpose)</h4>
                        <p class="mb-4">
                            This Laravel 10 Admin Login project is created for testing and demonstration purposes only.
                            During the testing process, the system may collect basic information such as your email address,
                            username, and password solely for the purpose of testing the following features:
                        </p>
                        <ul>
                            <li>Admin User Registration and Login</li>
                            <li>Two-Step Verification (via email)</li>
                            <li>Forgot Password and Reset Password</li>
                            <li>Admin Profile Management and Change Password</li>
                            <li>Logout</li>
                        </ul>

                        <p class="mb-4">
                            All data entered into this system is used locally for testing and is not shared, stored
                            permanently, or transmitted to any third party.
                        </p>

                        <p class="mb-4">
                            You are advised not to use any real personal information (such as real email addresses or
                            passwords) during testing.
                        </p>

                        <p class="mb-4">
                            By using this demo, you agree that it is for testing and educational purposes only, and the
                            developer assumes no responsibility for data loss or misuse resulting from improper use.
                        </p>

                        {{-- Register Link --}}
                        <p class="text-center">
                            <span>Go back to </span>
                            <a href="{{ route("register") }}">
                                <span>Register</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
