@extends('layouts.main')


@section('header')
<div class="row mb-2" >
          <div class="col-sm-6">
            <h1>Material</h1>
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
  <div style="font-size: 18px;" class="row">
    <div class="col">
      <div class="card">
        @if(auth()->user()->role === 'admin')
          <div class="card-header d-flex justify-content-end">
            <a href="/materials/create" class="btn btn-sm  btn-primary" style="font-size: 18px;">
              Add Material
            </a>
          </div>
        @endif
        <div class="card-body shadow-lg">
          <table class="table table-bordered table-hover" style="font-size: 18px;">
            <thead class="bg-gray">
              <tr>
                <th class="text-center" style="width: 1%;">No</th>
                <th class="text-center" style="width: 5%;">Material</th>
                <th class="text-center" style="width: 20%;">Description</th>
                <th class="text-center" style="width: 1%;">Price</th>
                <th class="text-center" style="width: 5%;">Stock</th>
                <th class="text-center" style="width: 10%;">Category</th>
                <th class="text-center" style="width: 10%;">Date & Time</th> 
                @if(auth()->user()->role === 'admin')
                <th class="text-center justify-content-end" style="width: 1%;">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($materials as $material)
                <tr>
                  <td>{{ ($materials->currentPage() - 1) * $materials->perPage() + $loop->index + 1 }}</td>
                  <td>{{ $material->name }}</td>
                  <td>{{ $material->description ?? '-' }}</td>
                  <td class="text-right">Rp{{ number_format($material->price, 0, ',', '.') }}</td>
                  <td class="text-center">{{ $material->stock }}</td>
                  <td class="text-center">{{ $material->category->name }}</td>
                  <td>{{ $material->updated_at->format('d M Y - H:i') }}</td>
                  @if(auth()->user()->role === 'admin')
                  <td>
                    <div class="d-flex justify-content-end" >
                      <a href="/materials/edit/{{ $material->id }}" class="btn btn-sm btn-warning mr-2" style="font-size: 18px;">Edit</a>
                      <!-- <form action="/materials/{{ $material->id }}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                        Delete
                        </button>
                      </form> -->
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $material->id }}" style="font-size: 18px;">
                        Delete
                      </button>
                    </div>
                  </td>
                  @endif
                </tr>
                @include('pages.materials.delete-confirmation')
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          {{ $materials->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>

@endsection