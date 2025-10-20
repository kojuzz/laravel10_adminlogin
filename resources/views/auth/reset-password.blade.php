@extends("layouts.app")

@section("title", "Reset Password")

@section("styles")
    <link rel="stylesheet" href="{{ asset("assets/css/page-auth.css") }}" />
@endsection

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
                        <h4 class="mb-1 pt-2">Reset Password</h4>
                        <p class="mb-4">Please reset your password.</p>

                        {{-- Form --}}
                        <form id="formAuthentication" class="mb-3" action="{{ route("reset-password.post") }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="mb-3 form-password-toggle">
                                <label for="password" class="form-label">Enter New Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" autocomplete="off" autofocus />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error("password")
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="confirm_password">Confirm New Password</label>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Enter your password"
                                        aria-describedby="confirm_password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error("confirm_password")
                                    <div class="text-danger text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Reset Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
