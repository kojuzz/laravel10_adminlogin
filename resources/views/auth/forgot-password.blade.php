@extends("layouts.app")

@section("title", "Forgot Password")

@section("styles")
    <link rel="stylesheet" href="{{ asset("assets/css/page-auth.css") }}" />
@endsection

@section("content")
    {{-- Flash Message --}}
    <div class="row">
        @if (session("success"))
            <x-flash :msg="session('success')" />
        @elseif (session("failed"))
            <x-flash :msg="session('failed')" bg="alert-danger" />
        @endif
    </div>

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">

                        {{-- Logo --}}
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route("login") }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <x-svg icon="vuexy" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bold">Admin Panel Test</span>
                            </a>
                        </div>
                        
                        {{-- Title --}}
                        <h4 class="mb-1 pt-2">Forgot Password?</h4>
                        <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

                        {{-- Form --}}
                        <form id="formAuthentication" class="mb-3" action="{{ route("forgot-password.post") }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus />
                            </div>
                            <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                        </form>

                        {{-- Login Link --}}
                        <div class="text-center">
                            <a href="{{ route("login") }}" class="d-flex align-items-center justify-content-center">
                                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection
