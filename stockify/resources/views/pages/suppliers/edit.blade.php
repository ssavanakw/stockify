@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Edit Supplier</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Supplier</li>
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
<div class="row">
    <div class="col">
        <form action="/suppliers/{{ $supplier->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Supplier Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $supplier->name) }}">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $supplier->email) }}">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $supplier->phone) }}">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address', $supplier->address) }}</textarea>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/suppliers" class="btn btn-sm btn-outline-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
