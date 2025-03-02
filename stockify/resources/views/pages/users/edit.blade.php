@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit User</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
@if ($errors->any())
    <script>
        Swal.fire({
            title: "Something went wrong",
            text: "@foreach($errors->all() as $error) {{ $error }} @endforeach",
            icon: "error",
            backdrop: false,
            position: "mid",
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true
        });
    </script>
@endif

{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Full Name --}}
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>

            {{-- Email --}}
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>

            {{-- Role --}}
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>

            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>

        <hr>

        {{-- Change Password Form --}}
        <h4>Change Password</h4>
        <form action="{{ route('users.updatePassword', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>

            <label for="new_password_confirmation">Confirm Password</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>

            <button type="submit" class="btn btn-warning mt-3">Update Password</button>
        </form>
    </div>
</div>
@endsection
