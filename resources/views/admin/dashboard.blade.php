@extends("layouts.app")

@section("title", "Dashboard")

@section("content")
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("layouts.admin.sidebar")
            <div class="layout-page">
                @include("layouts.admin.header")
            </div>
        </div>
    </div>
@endsection
