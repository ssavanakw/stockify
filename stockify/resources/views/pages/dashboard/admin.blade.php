@extends('layouts.main')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Dashboard</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item active"><a href="/">Home</a></li> -->
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- Material box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $materialCount }}</h3>
                <p>Material</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/materials" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
    <!-- Category box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $categoryCount }}</h3>
            <p>Category</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

@if(auth()->user()->role === 'admin')
<div class="col-lg-3 col-6">
    <!-- Users box (only visible to admin) -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $userCount }}</h3>
            <p>Users</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
@endif

    <div class="col-lg-3 col-6">
        <!-- Supplier box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $supplierCount }}</h3>
                <p>Supplier</p>
            </div>
            <div class="icon">
                <i class="fas fa-truck"></i>
            </div>
            <a href="/suppliers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
    <!-- Transaction box -->
    <div class="small-box bg-purple"> <!-- Menggunakan warna ungu -->
        <div class="inner">
            <h3>{{ $transactionCount }}</h3> <!-- Data transaksi dari controller -->
            <p>Transaction</p>
        </div>
        <div class="icon">
            <i class="fas fa-exchange-alt"></i> <!-- Icon transaksi -->
        </div>
        <a href="/stock-transactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
    <div class="col-lg-3 col-6">
        <!-- Report box (only visible to admin and manager) -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $reportCount }}</h3>
                <p>Report</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle py-1" style="font-size: 60px;"></i>
            </div>
            <a href="/reports" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
</div>
<!-- Tambahkan Grafik di sini -->
<div class="row">
    <div class="col-12">
        <div class="card d-flex flex-column shadow-lg">
            <div class="card-header">
                <h3 class="card-title">Overview Chart</h3>
            </div>
            <div class="card-body">
                <canvas id="overviewChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("overviewChart").getContext("2d");

        var chartData = JSON.parse('@json($overviewChartData)');

        var overviewChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: "Total Count",
                    data: chartData.data,
                    backgroundColor: ["#17a2b8", "#28a745", "#ffc107", "#007bff", "#6f42c1", "#dc3545"]
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>

<div class="row">
    <div class="col-lg-12">
        <!-- Assign Task -->
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
        <div class="card shadow-lg w-100 mb-4">
            <div class="card-body">
                <h2>Assign a New Task</h2>
                <form action="{{ route('tasks.assign') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="form-label" style="font-size: 18px;">Task Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label" style="font-size: 18px;">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label" style="font-size: 18px;">Assign to</label>
                        @if($staffUsers->isNotEmpty())
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Select --</option>
                            @foreach($staffUsers as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @else
                        <p class="text-danger">No eligible staff available for task assignment.</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Assign Task</button>
                </form>
            </div>
        </div>
        @endif

        <!-- Job List -->
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager' || auth()->user()->role === 'staff')
        <div class="card shadow-lg w-100">
            <div class="card-body">
                <h2>Job</h2>
                <table class="table table-bordered" style="font-size: 18px;">
                    <thead class="text-center bg-gray">
                        <tr>
                            <th width="10px">No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($pendingTasks as $key => $task)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                <span class="badge {{ $task->status === 'completed' ? 'bg-success' : 'bg-warning' }}" style="font-size: 18px;">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>{{ $task->user->name ?? '-' }}</td>
                            <td>
                                @php
                                    $role = $task->user->role ?? '-';
                                    $roleBadge = match ($role) {
                                        'admin' => 'bg-danger',
                                        'manager' => 'bg-success',
                                        'staff' => 'bg-primary',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $roleBadge }}" style="font-size: 16px;">
                                    {{ ucfirst($role) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d M Y H:i') }}</td>
                            <td>
                                @if(auth()->user()->role === 'staff' && $task->status !== 'completed')
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm" style="font-size: 18px;">
                                        <i class="fas fa-check-circle"></i> Complete
                                    </button>
                                </form>
                                @else
                                <span class="text-muted">No Action</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var materialData = JSON.parse('@json($materialData ?? [0, 0])');
        var userData = JSON.parse('@json($userData ?? [0, 0])');

        console.log("Material Data:", materialData);
        console.log("User Data:", userData);

        var ctxMaterial = document.getElementById('materialChart').getContext('2d');
        new Chart(ctxMaterial, {
            type: 'doughnut',
            data: {
                labels: ['Materials', 'Categories'],
                datasets: [{
                    label: 'Total Count',
                    data: materialData,
                    backgroundColor: ['#36A2EB', '#4CAF50'],
                    hoverBackgroundColor: ['#1E88E5', '#388E3C']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        var ctxUser = document.getElementById('userChart').getContext('2d');
        new Chart(ctxUser, {
            type: 'bar',
            data: {
                labels: ['Users', 'Suppliers'],
                datasets: [{
                    label: 'Total Count',
                    data: userData,
                    backgroundColor: ['#FFC107', '#0000FF'],
                    hoverBackgroundColor: ['#FFA000', '#00008A']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

</script>

