@extends('layouts.main')


@section('header')
<div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
@endsection

@section('content')
  @if(session('success'))
  <script>
        Swal.fire({
            title: "Great success",
            text: "{{ session('access') }}",
            icon: "success",
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
      <div class="card">
      @if(auth()->user()->role === 'admin')  
      <div class="card-header d-flex justify-content-end">
        <a href="/categories/create" class="btn btn-sm  btn-primary" style="font-size: 18px;">
          Add Category
        </a>
      </div>
      @endif
        <div class="card-body shadow-lg" style="font-size: 18px;">
          <table class="table table-bordered tables-layout-fixed table-hover">
            <thead class="bg-gray">
              <tr>
                <th width=10px>No</th>
                <th>Name</th>
                <th>Slug</th>
                @if(auth()->user()->role === 'admin')
                  <th class="text-center" width="100px">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->index + 1 }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->slug ?? '-' }}</td>
                  @if(auth()->user()->role === 'admin')
                  <td>
                    <div class="d-flex justify-content-end">
                        <a href="/categories/edit/{{ $category->id }}" style="font-size: 18px;" class="btn btn-sm btn-warning mr-2">
                            Edit
                        </a>
                        
                        <button style="font-size: 18px;" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $category->id }}">
                            Delete
                        </button>
                    </div>
                  </td>
                  @endif
                </tr>
                @include('pages.categories.delete-confirmation')
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          {{ $categories->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>

@endsection