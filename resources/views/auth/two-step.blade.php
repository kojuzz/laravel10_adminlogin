@extends("layouts.app")

@section("title", "Two Step Verification")

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

    {{-- Content --}}
    <div class="authentication-wrapper authentication-basic px-4">
        <div class="authentication-inner py-4">
            <!--  Two Steps Verification -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4 mt-2">
                        <a href="{{ route("login") }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <x-svg icon="vuexy" />
                            </span>
                            <span class="app-brand-text demo text-body fw-bold ms-1">Admin Panel Test</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-1 pt-2">Two Step Verification</h4>
                    <p class="text-start mb-4">
                        We sent a verification code to your mobile. Enter the code from the mobile in the field below.
                    </p>
                    <p class="mb-0 fw-medium">Type your 6 digit security code</p>
                    <form id="twoStepsForm" action="{{ route("two-step.post") }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div
                                class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" autofocus />
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" />
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" />
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" />
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" />
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" />
                            </div>
                            <!-- Create a hidden field which is combined by 3 fields above -->
                            <input type="hidden" name="otp" />
                            <input type="hidden" name="otp_token" value="{{ $otpToken }}">
                        </div>
                        <button class="btn btn-primary d-grid w-100 mb-3">Verify my account</button>
                    </form>
                    <div class="text-center">
                        <form action="{{ route("resend-otp") }}" method="POST">
                            @csrf
                            Didn't get the code?
                            <input type="hidden" name="otp_token" value="{{ $otpToken }}">
                            <button type="submit" class="btn btn-outline-none btn-link btn-md px-1">Resend</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- / Two Steps Verification -->
        </div>
    </div>

    {{-- Logout Button --}}
    <div class="position-fixed top-0 end-0 z-0 px-5 py-4">
        <a href="{{ route("admin.logout") }}">
            <i class="ti ti-logout me-2 ti-sm"></i>
        </a>
    </div>
@endsection


@section("scripts")
    {{-- Check Auth --}}
    <script src="{{ asset("assets/js/pages-auth.js") }}"></script>
    <script src="{{ asset("assets/js/pages-auth-two-steps.js") }}"></script>
@endsection
