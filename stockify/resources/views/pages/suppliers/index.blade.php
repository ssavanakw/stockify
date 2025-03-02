@extends('layouts.main')

@section('content')
<div class="card-header shadow-lg">
    <h1>Supplier List</h1>

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add Supplier</a>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered table-hover mt-3 shadow-lg" style="font-size: 18px;">
        <thead class="bg-gray">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                @if(auth()->user()->role === 'admin') 
                    <th class="text-center justify-content-end" style="width: 1%;">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address }}</td>
                    @if(auth()->user()->role === 'admin') 
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
