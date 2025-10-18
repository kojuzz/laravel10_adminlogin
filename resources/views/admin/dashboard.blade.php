@extends("layouts.admin.app")

@section("title", "Dashboard")

@section("content")
    <h2>Dashboard</h2>
    <p>{{ $user->name }}</p>
@endsection
