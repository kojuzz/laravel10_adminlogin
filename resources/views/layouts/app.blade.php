<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>
    <meta name="description" content="@yield("description", "")" />

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/images/svg/vuexy.svg") }}" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    {{-- Icons --}}
    <link rel="stylesheet" href="{{ asset("assets/css/fontawesome.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/tabler-icons.css") }}" />

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset("assets/css/demo.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/theme-default.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/core.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/css/perfect-scrollbar.css") }}" />

    {{-- Helper & Config JS --}}
    <script src="{{ asset("assets/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>

    {{-- Custom CSS --}}
    @yield("styles")
</head>

<body>
    {{-- Content --}}
    @yield("content")

    {{-- Core JS --}}
    <script src="{{ asset("assets/js/jquery.js") }}"></script>
    <script src="{{ asset("assets/js/popper.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/js/perfect-scrollbar.js") }}"></script>
    <script src="{{ asset("assets/js/menu.js") }}"></script>

    {{-- Live JS --}}
    <script src="{{ asset("assets/js/popular.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap5.js") }}"></script>
    <script src="{{ asset("assets/js/auto-focus.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>

    {{-- Custom Script --}}
    @yield("scripts")
</body>

</html>
