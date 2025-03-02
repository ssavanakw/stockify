@extends('layouts.main')

@section('content')
    <h2>Edit Supplier</h2>
    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $supplier->name }}" required>
        <input type="email" name="email" value="{{ $supplier->email }}" required>
        <input type="text" name="phone" value="{{ $supplier->phone }}">
        <textarea name="address">{{ $supplier->address }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection
