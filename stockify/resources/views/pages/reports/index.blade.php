@extends('layouts.main')

@section('header')
<div class="card px-3 py-2 shadow-lg w-full">
    <h1>Manage Reports</h1>

    @if(session('success'))
      <script>
          Swal.fire({
              title: "Great success",
              text: "{{ session('access') }}",
              icon: "success",
              backdrop: false,
              position: "mid",
              allowOutsideClick: true,
              allowEscapeKey: true,
              allowEnterKey: true
          });
      </script>
    @endif
    <div class="d-flex justify-content-end">
    <a href="{{ route('reports.create') }}"  class="btn btn-primary mt-1">Create New Report</a>
    </div>
 
    <div style="font-size: 18px;" class="table-responsive shadow-lg w-full mt-3 p-3">
        <table class="table table-bordered table-hover">
            <thead class="bg-gray">
                <tr>
                    <th class="text-center" style="width: 5%;">ID</th>
                    <th class="text-center" style="width: 15%;">Title</th>
                    <th class="text-center" style="width: 30%;">Description</th>
                    <th class="text-center" style="width: 10%;">User</th>
                    <th class="text-center" style="width: 10%;">Role</th>
                    <th class="text-center" style="width: 10%;">Status</th>
                    <th class="text-center" style="width: 15%;">Created At</th>
                    @if(auth()->user()->role === 'admin')
                    <th class="text-center" style="width: 10%;">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td class="text-center">{{ ($reports->currentPage() - 1) * $reports->perPage() + $loop->index + 1 }}</td>
                        <td class="text-center">{{ $report->title }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="text-break">{{ $report->description }}</span>
                            </div>
                        </td>
                        <td class="text-center">{{ $report->user->name }}</td>
                        <td class="text-center">
                            <span style="font-size: 18px;" class="badge font-weight-bold 
                                {{ $report->user->role == 'admin' ? 'badge-danger' : 
                                   ($report->user->role == 'manager' ? 'badge-success' : 'badge-info') }}">
                                {{ ucfirst($report->user->role) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <!-- <span style="font-size: 18px;" class="badge font-weight-bold  
                                {{ $report->status == 'pending' ? 'badge-warning' : 
                                ($report->status == 'resolved' ? 'badge-info' : 'badge-secondary') }}">
                                {{ ucfirst($report->status) }}
                            </span> -->
                            <span style="font-size: 18px;" class="badge font-weight-bold  
                                {{ $report->status == 'pending' ? 'badge-warning' : 
                                ($report->status == 'completed' ? 'badge-success' : 'badge-secondary') }}">
                                {{ ucfirst($report->status) }}
                            </span>
                        </td>
                        <td class="text-center">{{ $report->created_at }}</td>
                        @if(auth()->user()->role === 'admin')
                        <td class="text-center">
                            <form action="{{ route('reports.delete', $report->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button style="font-size: 18px;" type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
