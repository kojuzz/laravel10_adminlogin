@extends("layouts.admin.app")

@section("title", "Admin List")

@section("content")
    {{-- Breadcrumb --}}
    <h4 class="py-3 mb-4">
        <a href="{{ route("admin.dashboard") }}" class="text-muted fw-light">Dashboard /</a>
        Admin List
    </h4>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Admin Name</th>
                        <th>Admin Email</th>
                        <th>Username</th>
                        <th>Email Varify</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($admins as $admin)
                        <tr>
                            <td>
                                <span class="fw-medium">{{ $admin->name }}</span>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>
                                @if ($admin->email_verified_at)
                                    <span class="badge bg-label-success me-1">Verified</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Not Verified</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="justify-content-center mx-3 mt-2">
                {{ $admins->links("pagination::bootstrap-5") }}
            </div>
        </div>
    </div>
@endsection
