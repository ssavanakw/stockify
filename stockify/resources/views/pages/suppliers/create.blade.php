@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Create Supplier</h1>
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
            html: `{!! implode('<br>', $errors->all()) !!}`,
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
    <div class="col-md-8 offset-md-2">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Supplier Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-outline-secondary mr-2">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary">Save Supplier</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection
