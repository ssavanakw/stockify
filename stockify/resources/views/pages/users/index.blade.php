@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Manage Users</h1>
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

<div class="row shadow-lg">
    <div class="col">
        <div class="card">
            <div class="text-center">
                
            </div>
            <!-- <div class="card-header d-flex justify-content-end">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                    Add User
                </a>
            </div> -->
            <div class="card-body">
                <table style="font-size: 18px;" class="table table-bordered table-hover">
                    <thead class="bg-gray">
                        <tr>
                            <th width="10px">No</th>
                            <th class="justify-center">Name</th>
                            <th>Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center" width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <span style="font-size: 18px;" class="badge font-weight-bold 
                                    badge-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'manager' ? 'success' : 'primary') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center ">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning mr-2" style="font-size: 18px;">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button style="font-size: 18px;" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection
