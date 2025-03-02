@extends('layouts.main')


@section('header')
<div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Material</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Material</li>
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
                backdrop: false,  // Prevents background blur and layout shift
                position: "mid",  // Moves alert to the top to avoid covering form
                allowOutsideClick: true,  // Allows clicking outside to close
                allowEscapeKey: true,  // Allows pressing "Esc" to close
                allowEnterKey: true  // Allows pressing "Enter" to close
            });
        </script>
    @endif
  <div class="row">
    <div class="col">
        <form action="/materials/store" method="POST">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Material Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Description</label>
                        <textarea 
                        name="description" 
                        id="description" 
                        cols="30" 
                        rows="10" 
                        class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" inputmode="numeric" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                        @error('price')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" inputmode="numeric" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                        @error('stock')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                    @error('category_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/materials" class="btn btn-sm btn-outline-secondary mr-2" >Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>

@endsection