@extends('layouts.main')

@section('content')
<div class="card-header px-3 py-2 shadow-lg">
    <h1>Stock Transactions</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
    <a href="{{ route('stock-transactions.create') }}" class="btn btn-primary mb-3">Add Transaction</a>
    @endif
    <table class="table table-bordered shadow-lg">
        <thead>
            <tr class="bg-gray">
                <th>ID</th>
                <th>Material</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Description</th>
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->material->name }}</td>
                    <td>{{ $transaction->transaction_type == 'in' ? 'Stock In' : 'Stock Out' }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                    <td>{{ $transaction->description ?? '-' }}</td>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                    <td>
                        <form action="{{ route('stock-transactions.destroy', $transaction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
