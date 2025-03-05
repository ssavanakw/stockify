@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Add Report</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
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
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="form-label">Report Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('reports.index') }}" class="btn btn-sm btn-outline-secondary mr-2">Cancel</a>
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
